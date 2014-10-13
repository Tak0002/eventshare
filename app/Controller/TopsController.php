<?php

App::import('Vendor', 'htmlPurifier', array('file' => 'HtmlPurifier/HTMLPurifier.auto.php'));
App::import('Vendor', 'TimelineMaker', array('file' => 'TimelineMaker/TimelineMaker.php'));

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TopsController extends AppController {
    public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
        'Event'
    );
    public $uses = array('Event', 'Tag', 'EventComment', 'EventsTag', 'EventsUser', 'UsersTag');//使うテーブル
    public $components = array('Session' ,
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'Twitter',
                'action' => 'connect',
            )
        )
    );
    public $layout = 'twioff';

    public function sidebar() {
        $topEvents = $this->Event->find(
            'all', array(
                'order' => 'Event.participant desc',
                'conditions' => array('event_date >=' => date('Y-m-d', time())),
                'limit' => 3
                )
            );
        foreach ($topEvents as $key => $topEvent) {
            $value = strip_tags($topEvent['Event']['body']);
            $topEvents[$key]['Event']['body'] = mb_strimwidth($value, 0, 200, "", "UTF-8");
        }
        $topTags = $this->Tag->find(
            'all', array(
                'order' => 'follower desc',
                'limit' => 20
                )
            );
        return ['topEvents' => $topEvents,'topTags' => $topTags];
    }
    
    public function index() {
        $this->layout = 'event';
        $timelineMaker = new TimelineMaker($this->Auth->user());
        $events = $timelineMaker->getEvents(1, 'Event.id desc', 10, false);
        $recommends = $timelineMaker->getEvents(1, 'Event.participant desc',3 ,false);
        $this->set('events', $events);
        $this->set('recommends', $recommends);
    }    

    public function indexNext($page = null) {
        if (!$page) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->layout = null;
        $timelineMaker = new TimelineMaker($this->Auth->user());
        $event = $timelineMaker->getEvents($page, 'Event.id desc', 10, false);
        $this->set('events', $event);
        $this->set('page',$page);
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
    
    public function tag($id = null) {    
        $tag = $this->Tag->findById($id);
        if (!$tag) {
            throw new NotFoundException(__('Invalid post'));
        }
        $isFollow = $this->isfollowTag($id);
        $this->layout = 'event';
        $eventList = new EventListMaker();
        $eventIdList = $eventList->getEventIdListFromTagList($id);
        $events = $eventList->getEventList($eventIdList, 1);
        $this->set('events', $events);
        $this->set('tags', $tag['Tag']);
        $this->set('isFollow',$isFollow);        
    }
    
    private function isfollowTag($id) {
        $user = $this->Auth->user();
        if ($this->UsersTag->find('first', array('conditions' => array('tag_id' => $id, 'user_id' => $user['id'])))) {
            return true;
        }
        return false;
    }

    public function tagNext($id = null,$page = 1) {
        $tag = $this->Tag->findById($id);
        if (!$tag) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->layout = 'event';
        $eventList = new EventListMaker();
        $eventIdList = $eventList->getEventIdListFromTagList($id);
        $events = $eventList->getEventList($eventIdList, $page);
        $this->set('events', $events);
        $this->set('page',$page);
        $this->set('tags', $tag['Tag']);
    }
    

    /**
     * 
     * @param type $id
     * @return type
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function followTag($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $tag = $this->Tag->findById($id);
        if (!$tag) {
            throw new NotFoundException(__('Invalid post'));
        }
        $user = $this->Auth->user();
        if($this->UsersTag->find('first', array('conditions' => array('tag_id' => $id, 'user_id' => $user['id'])))){
            throw new MethodNotAllowedException();
        }
        $usersTag['tag_id'] = $id;
        $usersTag['user_id'] = $user['id'];
        $this->UsersTag->create();
        if ($this->UsersTag->save($usersTag)) {
            $tag['Tag']['follower'] ++;
            $tag = $this->Tag->save($tag);
            $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>フォローしました。</div>'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    public function unFollowTag($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $tag = $this->Tag->findById($id);
        if (!$tag) {
            throw new NotFoundException(__('Invalid post'));
        }
        $user = $this->Auth->user();
        if($this->UsersTag->deleteAll(array('tag_id' => $id, 'user_id' => $user['id']))){
            $tag['Tag']['follower'] --;
            $tag = $this->Tag->save($tag);
            $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>フォローを解除しました。</div>'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>フォローを解除に失敗しました。</div>'));
    }


    public function event($id = null) {
        $this->layout = 'event';
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $event = $this->Event->findById($id);
        if (!$event) {
            throw new NotFoundException(__('Invalid post'));
        }
        $user = $this->Auth->user();
        $status = 0;
        if ($event['Event']['owner_id'] === $user['id']){
            $status = 1;
        } else {
            foreach ($event['User'] as $users) {
                if ($users['id'] === $user['id']) {
                    $status = $users['EventsUser']['status'];
                }
            }
        }
        $this->set('event', $event);
        $this->set('status', $status);
        
        if ($this->request->is('Post')) {
            $this->EventComment->create();
            $eventComment = $this->request->data['eventcomment'];
            $user = $this->Auth->user();
            $eventComment['event_id'] = $id;
            $eventComment['user_id'] = $user['id'];
            if ($this->EventComment->save($eventComment)) {
                $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>コメントを投稿しました。</div>'));
                return $this->redirect(array('action' => 'event' ,$id));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }
    
    public function add()
    {
        $this->layout = 'event';
        if ($this->request->is('Post')) {
            $this->Event->create();
            $event = $this->request->data['event'];
            $user = $this->Auth->user();
            $event['owner_id'] = $user['id'];
            $event['body'] = $this->cleanHtml($event['body']);
            $event2 = $this->Event->save($event);
            if ($event2) {
                if($this->request->data['tags']){
                    $this->checkTags($this->request->data['tags'], $event2["Event"]["id"]);
                }
                $this->adminJoin($event2["Event"]["id"], 1);
                $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>イベントを作成しました。</div>'));
                return $this->redirect(array('action' => 'event' ,$event2["Event"]["id"]));
            }
            $this->Session->setFlash(__('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>イベントの作成に失敗しました。内容を確認してください</div>'));
        }
    }
    
    /**
     * カンマ区切りで送信された文字列型のタグを保存します。
     * @param string $strTags カンマ区切りのタグ
     * @param int $eventId EventのIDです。
     */
    private function checkTags($strTags, $eventId) {
        //引数のイベントIDのタグを全て削除する処理をここに入れる。
        $tags = explode(',', $strTags);
        $i = 0;
        foreach ($tags as $tag) {
            $tagId = $this->getTagId($tag);
            $eventsTag = ['event_id'=> $eventId, 'tag_id'=> $tagId];
            $this->EventsTag->create();
            $this->EventsTag->save($eventsTag);
            unset($eventsTag);
            $i++;
            if($i>10){
                break;
            }
        }
    }
    
    /**
     * タグ名からタグのIDを返します。存在しなければ新規作成します。
     * @param string $tagname タグの名前です。
     * @return int タグのID
     */
    private function getTagId($tagname){
        $tagname = h(trim($tagname));
        $options = array('conditions' => array('Tag.name' => $tagname));
        $tag = $this->Tag->find('first', $options);
        if(!$tag){
            $this->Tag->create();
            $tag['Tag']['name'] = $tagname;
            $tag['Tag']['follower'] = 0;
            $tag = $this->Tag->save($tag);
        }
        return $tag['Tag']['id'];
    }
    
    /**
     * ユーザーIDからユーザー情報を返します
     * @param int $id
     */
    private function getUserData($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid post'));
        }
        $userInfo = array();
        $userInfo['twitter_screen_name'] = $user['User']['twitter_screen_name'];
        $userInfo['name'] = $user['User']['name'];
        $userInfo['profile_image_url'] = $user['User']['profile_image_url'];
        return $userInfo;
    }
    
    public function jsonTags() {
        $tags = $this->Tag->find('all');
        $tagsList = array();
        foreach ($tags as $tag) {
            $tagsList[] = $tag['Tag']['name'];
        }
        $this->viewClass = 'Json';
        $this->set(compact('tagsList'));
        $this->set('_serialize', 'tagsList');
    }

    public function jsonYahooMap($placename = null,$pref = null) {
        if($placename == null){
            exit;
        }
        $json = file_get_contents('http://search.olp.yahooapis.jp/OpenLocalPlatform/V1/localSearch?appid=dj0zaiZpPWl1Yk9iQUpsV1I2ZSZzPWNvbnN1bWVyc2VjcmV0Jng9ZGI-&output=json&ac='.$pref.'&query=' . $placename);
        $originalData = json_decode($json, true);
        $newData = array();
        foreach ($originalData['Feature'] as $key => $value) {
            $newData[$key] = array($value['Name'],$value['Geometry']['Coordinates'],$value['Property']['Address']);
        }
        $this->viewClass = 'Json';
        $this->set(compact('newData'));
        $this->set('_serialize', 'newData');
    }
    
    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        
        $post = $this->Event->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $this->Event->id = $id;
            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }
        
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
    
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $user = $this->Auth->user();
        $event = $this->Event->findById($id);
        if(!$event['Event']['owner_id'] === $user['id']){
            throw new MethodNotAllowedException();
        }
        if ($this->Event->delete($id)) {
            $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>イベントを削除しました。</div>'));
            return $this->redirect(array('action' => 'index'));
        }
    }
    
    
    public function join($id, $status = 2) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if($status == 1){
            throw new MethodNotAllowedException();
        }
        if($status == 0){
            $this->unJoin($id);
        } else {
            $this->adminJoin($id, $status);
            $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>ステータスを変更しました。</div>'));
            return $this->redirect(array('action' => 'event' ,$id));
        }
    }

    /**
     * 
     * @param int $id
     * @param int $status(0番、削除。1番イベントの管理者、2番通常参加者、3番未定)
     * @return boolean
     */
    private function adminJoin($id, $status) {
        $user = $this->Auth->user();
        $options = array('conditions' => array(
            'and' => array(
                'event_id' => $id,
                'user_id' => $user['id']
            )
        ));
        $eventUser = $this->EventsUser->find('first', $options);
        if(!$eventUser){
            $this->EventsUser->create();
            $eventUser['EventsUser']['event_id'] = $id;
            $eventUser['EventsUser']['user_id'] = $user['id'];
        }
        $eventUser['EventsUser']['status'] = $status;
        if (!$this->EventsUser->save($eventUser)) {
            return false;
        }
        $this->countEventParticipant($id);
    }
    
    private function unJoin($id) {
        $user = $this->Auth->user();
        $options = array('conditions' => array(
            'and' => array(
                'event_id' => $id,
                'user_id' => $user['id']
            )
        ));
        $eventUser = $this->EventsUser->find('first', $options);
        if(!$eventUser){
            throw new MethodNotAllowedException();
        }
        $tableid = $eventUser['EventsUser']['id'];
        
        if ($this->EventsUser->delete($tableid)) {
            $this->countEventParticipant($id);
            $this->Session->setFlash(__('<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>参加を取り消しました。</div>'));
            return $this->redirect(array('action' => 'event' ,$id));
        }
    }
    
    private function countEventParticipant($eventId){
        
        $participant = $this->EventsUser->find(
                'count',
               ['conditions' => 
                    ['event_id' => $eventId,
                     'status' => [1,2]
                    ]
               ]
        );
        $uncertain = $this->EventsUser->find(
                'count',
                array('conditions' => 
                    array('event_id' => $eventId,
                          'status' => 3)
                     )
                );
        $event = $this->Event->findById($eventId);
        $event['Event']['participant'] = (string)$participant;
        $event['Event']['uncertain'] = (string)$uncertain;

        $this->Event->save($event, false);
    }
}
