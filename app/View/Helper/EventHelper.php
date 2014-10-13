<?php
App::uses('AppHelper', 'View/Helper');

class EventHelper extends AppHelper {

    public $helpers = array('Html');

    /**
     * 
     * @param array $events
     */
    public function eventList($events,$name = '') {
        $pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
        ?> 
        <div class="accordion" id="accordionMain<?php echo $name; ?>">
            <?php foreach ($events as $event): ?>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionMain<?php echo $name; ?>" href="#collapseMain<?php echo $name.$event['Event']['id']; ?>" style="text-decoration: none;color:black;">
                                <div style="float: left;margin: 0px; width: 50px; padding: 0px;"><img src="<?php 
                                if (isset($event['User'][0]['profile_image_url'])) {
                                     echo $event['User'][0]['profile_image_url'];
                                } ?>">
                                </div>
                                <div style="margin-left:70px;" class="eventBoxHead">
                                    <strong><?php echo $event['Event']['name'] ?></strong>　作成者：<?php echo $event['User'][0]['twitter_screen_name']; ?><br>
                                    会場：<?php echo h($event['Event']['place_name']); ?>（<?php echo h($pref[$event['Event']['prefecture']]); ?>)<br>
                                    日時：<?php
                                        if (strtotime($event['Event']['event_date']) < strtotime(date('Y-m-d', time()))) {
                                            echo '<span style="color:red;">既に終了してます。</span>';
                                        } else {
                                            echo date('Y年m月d日', strtotime($event['Event']['event_date']));
                                        }
                                        ?><br>
                                    参加人数：<?php
                                    if(!$event['Event']['wanted_max'] === null && $event['Event']['wanted_max'] <= $event['Event']['participant']){
                                        echo '<span style="color:red;">定員を超えています</span>';
                                    } else {
                                        echo h($event['Event']['participant']).'人';
                                    }?>
                                    
                                </div>
                        </a>
                    </div>
                    <div id="collapseMain<?php echo $name.$event['Event']['id']; ?>" class="accordion-body collapse">
                        <div class="accordion-inner">
                                <?php echo nl2br($event['Event']['body']); ?>
                            <div style="font-size:20px; margin: 5px;"><?php echo $this->Html->link('詳細を見る', array('controller' =>'tops','action' => 'event', $event['Event']['id']),array('class'=>'btn btn-primary')); ?></div>
                            <div style="border-top:solid gainsboro 1px;">
                                <?php
                                foreach ($event['Tag'] as $tag) {
                                    echo '<i class="icon-tag"></i>' . $this->Html->link($tag['name'], array('controller' =>'tops','action' => 'tag', $tag['id'])) . "\t";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
        <?php
    }

    
     public function eventListSmall($events,$name = '') {
        $pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
        ?> 
        <div class="accordion" id="accordionMain<?php echo $name; ?>">
            <?php foreach ($events as $event): ?>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionMain<?php echo $name; ?>" href="#collapseMain<?php echo $name.$event['Event']['id']; ?>" style="text-decoration: none;color:black;">

                                    <strong><?php echo $event['Event']['name'] ?></strong><br>
                                    作成者：<?php echo $event['User'][0]['twitter_screen_name']; ?><br>
                                    会場：<?php echo h($event['Event']['place_name']); ?>（<?php echo h($pref[$event['Event']['prefecture']]); ?>)<br>
                                    日時：<?php
                                        if (strtotime($event['Event']['event_date']) < strtotime(date('Y-m-d', time()))) {
                                            echo '<span style="color:red;">既に終了してます。</span>';
                                        } else {
                                            echo date('Y年m月d日', strtotime($event['Event']['event_date']));
                                        }
                                        ?><br>
                                    参加人数：<?php
                                    if(!$event['Event']['wanted_max'] === null && $event['Event']['wanted_max'] <= $event['Event']['participant']){
                                        echo '<span style="color:red;">定員を超えています</span>';
                                    } else {
                                        echo h($event['Event']['participant']).'人';
                                    }?>
                        </a>
                    </div>
                    <div id="collapseMain<?php echo $name.$event['Event']['id']; ?>" class="accordion-body collapse">
                        <div class="accordion-inner">
                                <?php echo nl2br($event['Event']['body']); ?>
                            <div style="border-top:solid gainsboro 1px;border-bottom:solid gainsboro 1px;">
                                <?php
                                foreach ($event['Tag'] as $tag) {
                                    echo '<i class="icon-tag"></i>' . $this->Html->link($tag['name'], array('controller' =>'tops','action' => 'tag', $tag['id'])) . "\t";
                                }
                                ?>
                            </div>
            <?php echo $this->Html->link('詳細を見る', array('controller' =>'tops','action' => 'event', $event['Event']['id']),array('class'=>'btn btn-primary')); ?>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
        <?php
    }
}
