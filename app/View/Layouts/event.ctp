    <?php
    $pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
    ?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo __('CakePHP: the rapid development php framework:'); ?>
            <?php echo $title_for_layout; ?>
        </title>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        <?php echo $this->Html->script('tag-it.min.js'); ?>
        <?php echo $this->Html->script('jquery.infinitescroll.min.js'); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <?php echo $this->Html->css('bootstrap.min'); ?>
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
                background-image: url(https://fbcdn-sphotos-h-a.akamaihd.net/hphotos-ak-frc3/t31/737950_247512555379017_1709589335_o.jpg);
                background-attachment: fixed;
            }
        
        </style>
        <?php echo $this->Html->css('bootstrap-responsive.min'); ?>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <!--
        <link rel="shortcut icon" href="/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
        -->
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
    </head>

    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo $this->Html->url(array("controller" => "tops","action" => "index")); ?>"><?php echo 'twioff'; ?></a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><?php echo $this->Html->link("マップ", array("controller" => "maps",'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link("カレンダー", array("controller" => "calendars",'action' => 'index')); ?></li>
                            <li><?php echo $this->Html->link("イベントを作成", array("controller" => "tops",'action' => 'add')); ?></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container">
            <?php echo $this->Session->flash(); ?>
            <div class="row-fluid">
                <div class="span4">
                    <?php echo $this->Html->image('twioff_logo.gif'); ?>
                </div>
                <div class="span8" style="height:100px;background-color:yellow;margin-bottom:10px;">
                    広告
                </div>
            </div>
            <div class="row-fluid">
                <?php echo $this->fetch('content'); ?>
            </div><!--/ぬわんぬわん-->

            <hr>

            <footer>
                <p>&copy; Company 2014</p>
            </footer>

        </div><!--/.fluid-container-->

        <!-- Le javascript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script-->
        <?php echo $this->Html->script('bootstrap.min'); ?>
        <?php echo $this->fetch('script'); ?>

    </body>
</html>
