<?php
App::import('Vendor', 'htmlPurifier', array('file' => 'HtmlPurifier/HTMLPurifier.auto.php'));

class UsersController extends AppController
{
    public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
        'Event'
    );
    public $uses = array('User','EventsUser', 'UsersTag');//使うテーブル
    public $components = array('Session' ,
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'Twitter',
                'action' => 'connect',
            )
        )
    );
    public $layout = 'event';
    
    public function t($screen_name = null) {
        if (!$screen_name) {
            throw new NotFoundException(__('Invalid post'));
        }
        $user = $this->User->find('first',['conditions' => ['twitter_screen_name' => $screen_name]]);
        $this->set('user',$user['User']);
    }
    
    public function edit() {
        $OriginalUser = $this->Auth->user();
        $OriginalUsers = $this->User->findById($OriginalUser['id']);
        $this->set('user',$OriginalUsers['User']);
        if ($this->request->is('Post')) {
            $user = $this->request->data['User'];
            $newUser['id'] = $OriginalUser['id'];
            $newUser['profile_body'] = $this->cleanHtml($user['profile_body']);
            if ($this->User->save($newUser)) {
                $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>プロフィールを更新しました。</div>'));
                return $this->redirect(array('action' => 't' ,$OriginalUser['twitter_screen_name']));
            }
            $this->Session->setFlash(__('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>プロフィールの更新に失敗しました。内容を確認してください</div>'));
        }
    }
    
    /**
     * bootsrap-wysiwygに合わせたエスケープ
     * @param string $html
     * @return string
     */
    private function cleanHtml($html) {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('URI.AllowedSchemes', array('http' => true, 'https' => true, 'mailto' => true, 'ftp' => true, 'nntp' => true, 'news' => true, 'data' => true));
        $config->set('Core.Encoding', 'UTF-8');
        $config->set('Core.Language', 'ja');
        $config->set('HTML.AllowedElements', array('a', 'em', 'p', 'h2', 'span', 'br', 'div'));
        $purifier = new HTMLPurifier();
        $ex = explode('<img src="data:image/', $html);
        if (count($ex) > 0) {
            $safeHtml = $purifier->purify($ex[0]);
            for ($i = 1; $i < count($ex); $i++) {
                $ex[$i] = explode('=">', $ex[$i], 2);
                if (strstr($ex[$i][0], '"')) {
                    $safeHtml = $safeHtml . $ex[$i][1];
                } else {
                    $ex[$i][1] = $purifier->purify($ex[$i][1]);
                    $safeHtml = $safeHtml . '<img src="data:image/' . $ex[$i][0] . '=">' . $ex[$i][1];
                }
            }
        } else {
            $safeHtml = $purifier->purify($ex[0]);
        }
        return $safeHtml;
    }
}