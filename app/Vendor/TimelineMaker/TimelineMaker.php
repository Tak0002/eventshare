<?php

class EventListMaker extends AppController
{
    public $uses = array('Event','EventsTag', 'UsersTag'); //使うテーブル

    
    /**
     * タグからイベントのID一覧を返します。
     * @return array イベントIDの一覧
     * @throws NotFoundException
     */
    public function getEventIdListFromTagList($tagId) {
        if (!$tagId) {
            throw new NotFoundException(__('タグがからです'));
        }
        $eventIds = $this->EventsTag->find(
                'all', array(
            'conditions' => array('tag_id' => $tagId),
            'fields' => array('event_id')
                )
        );
        $idList = array();
        foreach ($eventIds as $eventId) {
            $idList[] = $eventId['EventsTag']['event_id'];
        }
        return $idList;
    }

    /**
     * イベントIDから条件に合致したイベントの詳細を返します。
     * @param array,int $EventIdList
     * @param int $page
     * @param string $order
     * @param int $limit
     * @param bool $allowPast
     * @param array $fields
     * @return array
     * @throws NotFoundException
     */
    public function getEventList($EventIdList = null, $page = 1, $order = 'Event.id desc', $limit = 10,$allowPast = true,$fields = null)
    {
        if (!$EventIdList) {
            throw new NotFoundException(__('Invalid post'));
        }
        if($fields){
            $this->Event->unbindModel(['hasMany' => ['EventComment'],'hasAndBelongsToMany' => ['Tag','User']]);
        } else {
            $this->Event->unbindModel(['hasMany' => ['EventComment']]);
        }
        if ($allowPast) {
            $events = $this->Event->find(
                    'all', array(
                'order' => $order,
                'conditions' => array('id' => $EventIdList),
                'fields' => $fields,
                'page' => $page,
                'limit' => $limit
                    )
            );
        } else {
            $events = $this->Event->find(
                    'all', array(
                'order' => $order,
                'conditions' => array('id' => $EventIdList, 'event_date >=' => date('Y-m-d', time())),
                'fields' => $fields,
                'page' => $page,
                'limit' => $limit
                    )
            );
        }
        return $events;
    }
}

class TimelineMaker extends EventListMaker {


    /**
     * ユーザーがフォローしているタグのIDリストです。
     * @var array
     */
    private $followEventIdList = array();
    private $user;

    public function __construct($user,$request = null, $response = null) {
        $this->user = $user;
        $userFollowTagIdList = $this->getFollowTagIdList();
        $this->followEventIdList = $this->getEventIdListFromTagList($userFollowTagIdList);
        parent::__construct($request, $response);
    }


    /**
     * ユーザーがフォローしているタグのID一覧を作成し配列形式で返します。
     * @throws Exception
     */
    private function getFollowTagIdList() {
        $user = $this->user;
        if (!$user) {
            throw new Exception('ログインしていません。');
        }
        $tagsId = $this->UsersTag->find(
                'all', array(
            'conditions' => array('user_id' => $user['id']),
            'fields' => array('tag_id')
                )
        );
        $idList = array();
        foreach ($tagsId as $tagId) {
            $idList[] = $tagId['UsersTag']['tag_id'];
        }
        return $idList;
    }

    /**
     * イベントの詳細を返します。大変重い処理なので利用はほどほどに。
     * @param string $page ページ数の指定
     * @param string $order ソート順
     * @param int $limit 一回に取得する件数
     * @param bool $allowPast 過去のデータを含めるか
     * @return array
     */
    public function getEvents($page = 1, $order = 'Event.id desc', $limit = 10,$allowPast = true,$fields = null) {
        $idList = $this->followEventIdList;
        return $this->getEventList($idList, $page, $order, $limit, $allowPast,$fields);
    }
}
