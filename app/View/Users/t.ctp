    <?php
    $pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
    $url = 'https://twitter.com/'.$user['twitter_screen_name'].'/';
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
<div class="span7">
    <div style="background-color:white;padding:20px;border-radius: 5px;border: gainsboro solid 1px;">
        <h1><?php echo $this->Html->image($user['profile_image_url'], array('alt' => $user['twitter_screen_name'])); ?>
            <?php echo h($user['name']); ?></h1>
        <div style="margin-top: -20px;margin-left: 60px;margin-bottom: -10px;">
            
            <?php echo '@'.$this->Html->link($user['twitter_screen_name'],$url); ?>
        </div>
        <hr>
        <?php if(isset($user['profile_body'])){
                  echo $user['profile_body'];
              } else {
                  echo 'プロフィールは記入されていません…';
              }
        ?>
        <hr>
        <?php print_r($user); ?>
    </div>
</div>
<div class="span1">
   <div style="background-color:red;width: 160px;height: 600px;">広告</div>
</div>