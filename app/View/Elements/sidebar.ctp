<?php
$data = $this->requestAction('tops/sidebar');
$topEvents = $data['topEvents'];
$topTags = $data['topTags'];
?>
<style>
    #accordionSidebar > div,#accordionSidebar2 > div{
        background-color: white;
        margin-bottom: 15px;
        padding-top:10px;
        padding-bottom: 10px;
    }    
</style>
<div class="accordion" id="accordionSidebar">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionSidebar" href="#collapseOne">
                <h1>公式タグ一覧</h1>
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse">
            <div class="accordion-inner">
                <ul class="nav nav-list">
                    <li class="nav-header">スポーツ系</li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li class="nav-header">文化系</li>
                    <li><a href="#">Link</a></li>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="accordion" id="accordionSidebar2">
    <div class="accordion-group">
        <div class="accordion-heading">
            <div style="margin:15px;"><h1>人気のイベント</h1></div>
        </div>
        <div id="collapseTwo" class="accordion-body collapse in">
            <div class="accordion-inner">
                <?php echo $this->Event->eventListSmall($topEvents,'topEvents');?>
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
             <div style="margin:15px;"><h1>おすすめのタグ</h1></div>
        </div>
        <div id="collapseThree" class="accordion-body collapse in">
            <div class="accordion-inner">
                <ul class="nav nav-list">
                    <?php foreach ($topTags as $tag): ?>
                    <li><?php echo $this->Html->link($tag['Tag']['name'], ["controller" => "tops",'action' => 'tag',$tag['Tag']['id']]); ?></li>
                    <?php endforeach;?>
                </ul>

            </div>
        </div>
    </div>
</div>