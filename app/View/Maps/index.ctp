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
            var latlng = new google.maps.LatLng(35.342575,139.477615);
            var opts = {
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: latlng
            };
            // getElementById("map")の"map"は、body内の<div id="map">より
            map = new google.maps.Map(document.getElementById("map"), opts);

            $.ajax({
                url: '<?php echo $url; ?>',
                dataType: 'json',
                success: function(json) {
                    for(i = 0; i<json.length; i++){
                        var infoWindowOpts = {
                            position: new google.maps.LatLng(json[i]['place_latitude'],json[i]['place_longitude']),
                            content: "<a href='" + json[i]['url'] + "'>" + json[i]['title'] + "</a>"
                        };
                        // 直前で作成したInfoWindowOptionsを利用してInfoWindowを作成
                        var infowin = new google.maps.InfoWindow(infoWindowOpts);

                        // 地図上にInfoWindowを表示
                        infowin.open(map);
                    }
                }
            });
        };

        //]]>
    </script>
    <ul class="nav nav-tabs">
        <?php if($page === 'all'):?>
        <li><?php echo $this->Html->link('フォローしているイベント',array("controller" => "maps","action" => "index")); ?></li>
        <li class="active"><a>全て</a></li>
        <?php else :?>
        <li class="active"><a>フォローしているイベント</a></li>
        <li><?php echo $this->Html->link('全て',array("controller" => "maps","action" => "index",'all')); ?></li>
        <?php endif;?>
    </ul>
    <p>イベントを地図から見ることができます(直近200件まで表示)</p>
    <div id="map" style='width:100%;height:100%;min-height: 500px;margin:0px;'></div>
    <hr>
    <h1>都道府県から</h1>
    <?php
        foreach ($pref as $key => $value) {
            echo $this->Html->link($value,array('action' => 'prefecture', $key)) . "\t";
        }
    ?>

  </div>
</div>
<div class="span1">
    <div style="background-color:red;width: 160px;height: 600px;">広告</div>
</div>
