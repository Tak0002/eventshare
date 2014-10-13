<?php
App::import('Vendor', 'twitter', array('file' => 'Twitter/twitteroauth.php'));

class TwitterController extends AppController {
    public $name = 'Twitter';
    public $components = array('Session' ,
        'Auth' => array('allowedActions' => array('connect', 'callback'))
        );
    public $uses = array('User');//書き換え必須 DB table名
    
    public $consumer_key = '';//書き換え
    public $consumer_secret = '';
    public $twitter_callback_url = '';
    
    public function connect() {
        $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        $request_token = $connection->getRequestToken($this->twitter_callback_url);
        $oauth_token = $request_token['oauth_token'];
        $this->Session->write('oauth_token', $oauth_token);
        $this->Session->write('oauth_token_secret', $request_token['oauth_token_secret']);
        switch ($connection->http_code) {
            case 200:
                $url = $connection->getAuthorizeURL($oauth_token);
                $this->redirect($url);
                break;
        }
    }
    
    public function callback() {
        $oauth_token = $this->Session->read('oauth_token');
        $oauth_token_secret = $this->Session->read('oauth_token_secret');
        
        if(isset($this->request->query['oauth_token']) and $this->request->query('oauth_token') !== $oauth_token) {
            $this->redirect('/oauth/connect');
            exit();
        }
        
        $connection = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $oauth_token, $oauth_token_secret);
        $oauth_verifier = $this->request->query['oauth_verifier'];
        $token = $connection->getAccessToken($oauth_verifier);
        
        $twitter = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $token['oauth_token'], $token['oauth_token_secret']);
        $credentials = $twitter->get('account/verify_credentials');
        
        $options = array('conditions' => array('twitter_user_id' => $credentials->id_str));
        $user = $this->User->find('first', $options);
        
        if(!$user){
            $this->User->create();
            $user = array('User' => array('twitter_user_id' => $credentials->id_str));
        }
        unset($user['User']['modified']);
        $user['User']['oauth_token'] = $token['oauth_token'];
        $user['User']['oauth_token_secret'] = $token['oauth_token_secret'];
        $user['User']['twitter_screen_name'] = $credentials->screen_name;
        $user['User']['name'] = $credentials->name;
        $user['User']['profile_image_url'] = $credentials->profile_image_url;
        $user = $this->User->save($user);//if文で確かめたほうが良いかも。
        
        $this->Session->delete('oauth_token');
        $this->Session->delete('oauth_token_secret');
        
        $this->Auth->login($user['User']);
        $this->redirect($this->Auth->redirectUrl());
    }
}