<?php
App::import('Vendor', 'TimelineMaker', array('file' => 'TimelineMaker/TimelineMaker.php'));

class CalendarsController extends AppController
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
            $url = Router::url(array("controller" => "calendars","action" => "calendarAllJson"));
        } else {
            $url = Router::url(array("controller" => "calendars","action" => "calendarJson"));
        }
        $this->set('page', $page);
        $this->set('url',$url);
    }

    public function calendarJson() {
        $timelineMaker = new TimelineMaker($this->Auth->user());
        $events = $timelineMaker->getEvents(1, 'Event.id desc', 1000, true,array('id','name','event_date','event_time','event_end'));
        $CalEvents = $this->makeCalEvents($events);
        $this->viewClass = 'Json';
        $this->set(compact('CalEvents'));
        $this->set('_serialize', 'CalEvents');
    }
    
    public function calendarAllJson() {
        $events = $this->Event->find(
                'all', array(
                    'order' => 'Event.id desc',
                    'fields' => array('id','name','event_date','event_time','event_end'),
                    'limit' => 1000
                    )
                );
        $CalEvents = $this->makeCalEvents($events);
        $this->viewClass = 'Json';
        $this->set(compact('CalEvents'));
        $this->set('_serialize', 'CalEvents');
    }
    
    /**
     * event形式の配列をカレンダー対応にします。
     * @param array $events
     * @return boolean
     */
    private function makeCalEvents($events){
        $CalEvents = array();
        foreach ($events as $event) {
            $start = $event['Event']['event_date'].' '.$event['Event']['event_time'];
            $end = $event['Event']['event_date'].' '.$event['Event']['event_end'];
            $url = Router::url(array("controller" => "tops","action" => "event",$event['Event']['id']));
            $CalEvents[] = array('id' => $event['Event']['id'],'title' => $event['Event']['name'],'start' => $start,'end' => $end,'url' => $url,'allDay'=>false);
        }
        return $CalEvents;
    }

}