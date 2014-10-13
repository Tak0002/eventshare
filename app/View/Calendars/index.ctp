<div class="span9">
    <?php
    echo $this->Html->css('fullcalendar.css');
    echo $this->Html->css('fullcalendar.print.css');
    echo $this->Html->script('jquery-ui.custom.min.js');
    echo $this->Html->script('fullcalendar.min.js');
    ?>
    <script>
    $(document).ready(function() {
            $('#calendar').fullCalendar({
                    editable: false,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultView: 'agendaWeek',
                    // 時間の書式
                    timeFormat: 'H(:mm)',
                    // 列の書式
                    columnFormat: {
                        month: 'ddd',    // 月
                        week: "d'('ddd')'", // 7(月)
                        day: "d'('ddd')'" // 7(月)
                    },
                    // タイトルの書式
                    titleFormat: {
                        month: 'yyyy年M月',                             // 2013年9月
                        week: "yyyy年M月d日{ ～ }{[yyyy年]}{[M月]d日}", // 2013年9月7日 ～ 13日
                        day: "yyyy年M月d日'('ddd')'"                  // 2013年9月7日(火)
                    },
                    // ボタン文字列
                    buttonText: {
                        prev:     '&lsaquo;', // <
                        next:     '&rsaquo;', // >
                        prevYear: '&laquo;',  // <<
                        nextYear: '&raquo;',  // >>
                        today:    '今日',
                        month:    '月',
                        week:     '週',
                        day:      '日'
                    },
                    // 月名称
                    monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                    // 月略称
                    monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                    // 曜日名称
                    dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
                    // 曜日略称
                    dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],                    
                    
                    events: "<?php echo $url; ?>",
                    eventDrop: function(event, delta) {
                            alert(event.title + ' was moved ' + delta + ' days\n' +
                            '(should probably update your database)');
                },
                loading: function(bool) {
                    if (bool)
                        $('#loading').show();
                    else
                        $('#loading').hide();
                }
            });
        });
    </script>
    <style>
	#loading {
		position: absolute;
		top: 5px;
		right: 5px;
		}

	#calendar {
		width: 100%;
		margin: 0 auto;
		}

</style>    
    <div style="background-color:white;padding:20px;border-radius: 5px;border: gainsboro solid 1px;">
        <ul class="nav nav-tabs">
            <?php if($page === 'all'):?>
            <li><?php echo $this->Html->link('フォローしているイベント',array("controller" => "calendars","action" => "index")); ?></li>
            <li class="active"><a>全て</a></li>
            <?php else :?>
            <li class="active"><a>フォローしているイベント</a></li>
            <li><?php echo $this->Html->link('全て',array("controller" => "calendars","action" => "index",'all')); ?></li>
            <?php endif;?>
        </ul>
        <div id='loading' style='display:none'>loading...</div>
        <div id='calendar'></div>
    </div>
</div>
<div class='span2'>
    広告
</div>