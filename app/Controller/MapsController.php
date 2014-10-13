<?php
App::import('Vendor', 'TimelineMaker', array('file' => 'TimelineMaker/TimelineMaker.php'));

class MapsController extends AppController
{
    public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
        'Event'
    );
    public $uses = array('User','Event', 'UsersTag');//使うテーブル
    public $components = array('Session' ,
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'Twitter',
                'action' => 'connect',
            )
        )
    );
    public $layout = 'event';
    
    public function index($page = null) {
        $this->layout = 'event';
        if($page === 'all'){
            $url = Router::url(array("controller" => "maps","action" => "mapAllJson"));
        } else {
            $url = Router::url(array("controller" => "maps","action" => "mapJson"));
        }
        $this->set('page', $page);
        $this->set('url',$url);
    }

    public function mapJson() {
        $timelineMaker = new TimelineMaker($this->Auth->user());
        $events = $timelineMaker->getEvents(1, 'Event.id desc', 200, false,array('id','name','place_latitude','place_longitude'));
        $mapEvents = $this->makeMapEvents($events);
        $this->viewClass = 'Json';
        $this->set(compact('mapEvents'));
        $this->set('_serialize', 'mapEvents');
    }

    public function mapAllJson() {
        $events = $this->Event->find(
                'all', array(
                    'order' => 'Event.id desc',
                    'fields' => array('id','name','place_latitude','place_longitude'),
                    'conditions' => array('event_date >=' => date('Y-m-d', time())),
                    'limit' => 200
                    )
                );
        $mapEvents = $this->makeMapEvents($events);
        $this->viewClass = 'Json';
        $this->set(compact('mapEvents'));
        $this->set('_serialize', 'mapEvents');
    }
    
    
    /**
     * event形式の配列を地図対応にします。
     * @param array $events
     * @return boolean
     */
    private function makeMapEvents($events){
        $mapEvents = array();
        foreach ($events as $event) {
            $url = Router::url(array("controller" => "tops","action" => "event",$event['Event']['id']));
            $mapEvents[] = array('id' => $event['Event']['id'],'title' => $event['Event']['name'],'place_latitude' => $event['Event']['place_latitude'],'place_longitude'=>$event['Event']['place_longitude'],'url' => $url);
        }
        return $mapEvents;
    }
    
    public function prefecture($id = null) {
        $events = $this->getEventsFromPref($id,1);
        $this->set('events', $events);
        $this->set('id',$id);
    }

    public function prefectureNext($id = null,$page = 1) {
        $events = $this->getEventsFromPref($id,$page);
        $this->set('events', $events);
        $this->set('id',$id);
    }
    
    /**
     * イベントの情報を都道府県から呼び出します。
     * @param int $id
     * @param int $page
     * @return type
     * @throws NotFoundException
     */
    private function getEventsFromPref($id = null,$page = 1){
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $events = $this->Event->find(
                'all', array(
                    'order' => 'Event.id desc',
                    'conditions' => array('prefecture'=>$id),
                    'limit' => 10,
                    'page' => $page
                    )
                );
        if(isset($events[0]['Event']['body'])){
            foreach ($events as $key => $event) {
                $value = strip_tags($event['Event']['body']);
                $events[$key]['Event']['body'] = mb_strimwidth($value, 0, 200, "", "UTF-8");
            }
        }
        return $events;
    }
}
