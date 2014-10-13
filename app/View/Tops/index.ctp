<!-- File: /app/View/Events/index.ctp  (編集リンクを追加済み) -->
<?php
$pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
?>
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
</div>
<div class="span6">

<!-- $event配列をループして、投稿記事の情報を表示 -->

<?php //print_r($events); ?>
<div style="background-color:white;padding:5px;border-radius: 5px;border: gainsboro solid 1px;">
    <h1>オススメのイベント</h1>
    <?php echo $this->Event->eventList($recommends,'Recommends');?>
</div>
<div style="margin-top: 20px;background-color:white;padding:5px;border-radius: 5px;border: gainsboro solid 1px;">
    <h1>タイムライン</h1>
    <?php echo $this->Event->eventList($events,'TimeLine');?>
</div>
<div class="navigation">
<?php echo $this->Html->link('', array('action' => 'indexNext', 2));?>
<!-- /.navigation --></div>
</div>

<div class="span2">
    広告
</div>

<script>
$(function(){
    $('#accordionMainTimeLine').infinitescroll({
        navSelector  : ".navigation",
            // ナビゲーション要素を指定します。
        nextSelector : ".navigation a",
            // ナビゲーションの「次へ」の要素を指定します。
        itemSelector : "#accordionMainTimeLine .accordion-group",
            // 表示させる要素を指定します。
        dataType : "html"
            // 読み込むデータの形式を指定します。
    });
});
</script>