<style>


    .eventBoxHead span{
        margin-left: 15px;
    }

    h1{
        font-size: 20px;
    }

    .accordion-toggle:hover{
        background-color: ghostwhite;
    }
</style>

<div class="span3">
<?php echo $this->element('sidebar') ?>
</div><!--/span-->
<div class="span7">
    <div style="background-color:white;padding:20px;border-radius: 5px;border: gainsboro solid 1px;">
    <?php
    $pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
    ?>
    <script src="http://maps.google.com/maps/api/js?v=3&sensor=false"type="text/javascript" charset="UTF-8"></script>
    <script type="text/javascript">
        //<![CDATA[

        var map;

        // 初期化。bodyのonloadでinit()を指定することで呼び出してます
        window.onload = function() {

            // Google Mapで利用する初期設定用の変数
            var latlng = new google.maps.LatLng(<?php echo h($event['Event']['place_latitude']); ?>, <?php echo h($event['Event']['place_longitude']); ?>);
            var opts = {
                zoom: 9,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: latlng
            };

            // getElementById("map")の"map"は、body内の<div id="map">より
            map = new google.maps.Map(document.getElementById("map"), opts);

            // InfoWindowの初期設定
            var infoWindowOpts = {
                position: new google.maps.LatLng(<?php echo h($event['Event']['place_latitude']); ?>, <?php echo h($event['Event']['place_longitude']); ?>),
                content: "<?php echo h($event['Event']['place_name']); ?>"
            };
            // 直前で作成したInfoWindowOptionsを利用してInfoWindowを作成
            var infowin = new google.maps.InfoWindow(infoWindowOpts);

            // 地図上にInfoWindowを表示
            infowin.open(map);
        };

        //]]>
    </script>

<!--iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="float:right;" src="https://maps.google.co.jp/maps?q=35.3377,139.447164&amp;num=1&amp;brcurrent=3,0x601851ffc2e5f0bd:0x60fe1ab62946cfb0,0,0x60185201d4612bcf:0x7cb09254965db424&amp;ie=UTF8&amp;ll=35.337726,139.447618&amp;spn=0.001278,0.002642&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.jp/maps?q=35.3377,139.447164&amp;num=1&amp;brcurrent=3,0x601851ffc2e5f0bd:0x60fe1ab62946cfb0,0,0x60185201d4612bcf:0x7cb09254965db424&amp;ie=UTF8&amp;ll=35.337726,139.447618&amp;spn=0.001278,0.002642&amp;t=m&amp;z=14&amp;iwloc=A&amp;source=embed" style="color:#0000FF;text-align:left">大きな地図で見る</a></small>
    <!--img src="basyosampe.png" style="float:right;width:300px;margin:10px;"/-->
    <h2><?php echo $this->Html->image($event['User'][0]['profile_image_url'], array('alt' => $event['User'][0]['twitter_screen_name'])); ?>
        <?php echo h($event['Event']['name']); ?></h2>
    <div style="margin-top: -10px;margin-left: 50px;margin-bottom: -10px;">
        日時：<?php echo h($event['Event']['event_date'] . ' ' . $event['Event']['event_time']) . "\t　"; ?>
        会場：<?php echo h($event['Event']['place_name']); ?>（<?php echo h($pref[$event['Event']['prefecture']]) . ")\t　"; ?>
    </div>
    <hr>
    <div>
        <xmp><?php
//print_r($event);
var_dump($event);
        ?>    </xmp>
        <p><?php echo $event['Event']['body']; ?></p>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span5">
            <h3>詳細</h3>
            <p>作成者：<?php echo h($event['User'][0]['name']); ?></p>
            <p>日時：<?php echo h($event['Event']['event_date'] . ' ' . $event['Event']['event_time']. '〜' . $event['Event']['event_end']); ?></p>
            <p>会場：<?php echo h($event['Event']['place_name']); ?>（<?php echo h($pref[$event['Event']['prefecture']]); ?>)</p>
            <p>住所：<?php echo h($event['Event']['place_address']); ?></p>
            <p>参加人数：<?php echo h($event['Event']['participant']); ?>人（未定：<?php echo h($event['Event']['uncertain']); ?>人）</p>
            <p>募集人数：<?php echo h($event['Event']['wanted']); ?>人（定員<?php echo h($event['Event']['wanted_max']); ?>人）</p>
            <p><?php
                if ($status == 2) {
                    echo 'あたなは参加予定です。';
                    echo $this->Form->postLink(
                            '参加しない', array('action' => 'join', $event['Event']['id'], 0), array('class' => 'btn btn-danger')
                    );
                    echo $this->Form->postLink(
                            '未定', array('action' => 'join', $event['Event']['id'], 3), array('class' => 'btn')
                    );
                } elseif ($status == 1) {
                    echo 'あたなはイベントの作成者です。';
                    echo $this->Form->postLink(
                            'イベントを削除する', array('action' => 'delete', $event['Event']['id']), array('class' => 'btn btn-danger', 'confirm' => '削除するとイベントに関連するデータが全て削除されます。よろしいですか？')
                    );
                } elseif ($status == 3) {
                    echo 'あなたは未定です。';
                    echo $this->Form->postLink(
                            '参加する', array('action' => 'join', $event['Event']['id'], 2), array('class' => 'btn btn-success')
                    );
                    echo $this->Form->postLink(
                            '参加しない', array('action' => 'join', $event['Event']['id'], 0), array('class' => 'btn btn-danger')
                    );
                } else {
                    echo $this->Form->postLink(
                            '参加する', array('action' => 'join', $event['Event']['id'], 2), array('class' => 'btn btn-success')
                    );
                    echo $this->Form->postLink(
                            '未定', array('action' => 'join', $event['Event']['id'], 3), array('class' => 'btn')
                    );
                }
                ?></p>
        </div>
        <div id="map" style='width:300px;height:300px;margin:0px;'></div>
    </div>
    <hr>
    <div style="padding: 5px;">
        タグ：<?php
                foreach ($event['Tag'] as $tag) {
                    echo h($tag['name'] . ', ');
                }
                ?>
        <hr>
        <p>
            参加者：<?php
                foreach ($event['User'] as $user) {
                    echo h($user['name'] . ', ');
                }
                ?>
        </p>
<?php
echo $this->Form->create('eventcomment');
echo $this->Form->textarea('body', array('row' => '3'));
echo $this->Form->end('コメントを投稿', array('class' => 'btn btn-primary'));
?>
        <hr>
        <?php
        $eventComments = array_reverse($event['EventComment']);
        foreach ($eventComments as $eventComment):?>
        <div style="width: 90%;background-color:white;padding:20px;border-radius: 5px;border: gainsboro solid 1px;">
        <div style="float: left;margin: 0px; width: 50px; padding: 0px;"><img src="<?php 
        if (isset($eventComment['User']['profile_image_url'])) {
             echo $eventComment['User']['profile_image_url'];
         } ?>">
         </div>
        <div style="margin-left:70px;">
            <strong><?php echo h($eventComment['User']['name']); ?></strong><?php echo "\t@". h($eventComment['User']['twitter_screen_name']); ?><br>
             <?php echo nl2br(h($eventComment['body']));?>
        </div>
        <div align="right">
            <?php echo h($eventComment['created']);?>
        </div>
            </div>
        <?php endforeach;?>
    </div>
    <!--/div-->
    </div>
</div><!--/span-->
<div class="span1">
    <div style="background-color:red;width: 160px;height: 600px;">広告</div>
</div>
