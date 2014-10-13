<div class="span9">
    <div style="background-color:white;padding:20px;border-radius: 5px;border: gainsboro solid 1px;">
    <?php
    echo $this->Html->css('bootstrap-combined.no-icons.min.css');
    echo $this->Html->css('jquery.tagit.css');
    echo $this->Html->css('http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css');
    echo $this->Html->css('tagit.ui-zendesk.css');
    echo $this->Html->css('datepicker.css');
    echo $this->Html->css('bootstrap-timepicker.min.css');
    echo $this->Html->script('bootstrap-wysiwyg.js');
    echo $this->Html->script('jquery.hotkeys.js');
    echo $this->Html->script('bootstrap-datepicker.js');
    echo $this->Html->script('bootstrap-datepicker.ja.js');
    echo $this->Html->script('bootstrap-timepicker.min.js');
    ?>
    <h3>イベントを作成</h3>
    <style type="text/css">
        #map { height: 500px; width: 100%; }
        #editor {
            max-height: 250px;
            height: 250px;
            background-color: white;
            border-collapse: separate; 
            border: 1px solid rgb(204, 204, 204); 
            padding: 4px; 
            box-sizing: content-box; 
            -webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset; 
            box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
            border-top-right-radius: 3px; border-bottom-right-radius: 3px;
            border-bottom-left-radius: 3px; border-top-left-radius: 3px;
            overflow: scroll;
            outline: none;
        }

        div[data-role="editor-toolbar"] {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .dropdown-menu a {
            cursor: pointer;
        }
    </style>
    <script src="http://maps.google.com/maps/api/js?v=3&sensor=false"
    type="text/javascript" charset="UTF-8"></script>
    <script type="text/javascript">
        //<![CDATA[

        var map;
        var geo;
        var hasMarker = false;

        // 初期化。bodyのonloadでinit()を指定することで呼び出してます
        window.onload = function() {

            // Google Mapで利用する初期設定用の変数
            var latlng = new google.maps.LatLng(35.681382, 139.766084);
            var opts = {
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: latlng
            };

            // getElementById("map")の"map"は、body内の<div id="map">より
            map = new google.maps.Map(document.getElementById("map"), opts);

            // ジオコードリクエストを送信するGeocoderの作成
            geo = new google.maps.Geocoder();

        }

        function buttonpress() {
            // GeocoderRequest
            if (hasMarker) {
                alert('複数のマーカーが存在します。一番最後に作成したマーカーが有効になります。');
            }
            var req = {
                address: document.getElementById('eventPlaceAddress').value,
            };
            geo.geocode(req, geoResultCallback);
            hasMarker = true;
        }

        function geoResultCallback(result, status) {
            if (status != google.maps.GeocoderStatus.OK) {
                alert(status);
                return;
            }

            var latlng = result[0].geometry.location;

            map.setCenter(latlng);

            var marker = new google.maps.Marker({position: latlng, map: map, title: latlng.toString(), draggable: true});

            google.maps.event.addListener(marker, 'dragend', function(event) {
                marker.setTitle(event.latLng.toString());
                document.getElementById('eventPlaceLatitude').value = event.latLng.lat();
                document.getElementById('eventPlaceLongitude').value = event.latLng.lng();
            });
            document.getElementById('eventPlaceLatitude').value = latlng.lat();
            document.getElementById('eventPlaceLongitude').value = latlng.lng();
        }
        $(function() {
            $.ajax({
                url: '<?php echo $this->Html->url(array("controller" => "tops","action" => "jsontags")); ?>',
                dataType: 'json',
                success: function(data) {
                    $('#taginput').tagit({
                        availableTags: data,
                        tagLimit:10,
                        placeholderText: 'タグを入力してください'
                    });
                }
            });
            $('#eventEventDate').datepicker({
                format: "yyyy-mm-dd",
                startDate: "now",
                language: "ja",
                todayHighlight: true
            });
            $('#eventEventTime').timepicker({
                showMeridian: false,
                defaultTime: false
            });
            $('#eventEventEnd').timepicker({
                showMeridian: false,
                defaultTime: false
            });

            function initToolbarBootstrapBindings() {
                var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                    'Times New Roman', 'Verdana'],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                $.each(fonts, function(idx, fontName) {
                    fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                });
                $('a[title]').tooltip({container: 'body'});
                $('.dropdown-menu input').click(function() {
                    return false;
                })
                        .change(function() {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function() {
                            this.value = '';
                            $(this).change();
                        });

                $('[data-role=magic-overlay]').each(function() {
                    var overlay = $(this), target = $(overlay.data('target'));
                    overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                });
                if ("onwebkitspeechchange"  in document.createElement("input")) {
                    var editorOffset = $('#editor').offset();
                    $('#voiceBtn').css('position', 'absolute').offset({top: editorOffset.top, left: editorOffset.left + $('#editor').innerWidth() - 35});
                } else {
                    $('#voiceBtn').hide();
                }
            }
            ;
            function showErrorAlert(reason, detail) {
                var msg = '';
                if (reason === 'unsupported-file-type') {
                    msg = "Unsupported format " + detail;
                }
                else {
                    console.log("error uploading file", reason, detail);
                }
                $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
            }
            ;
            initToolbarBootstrapBindings();
            $('#editor').wysiwyg({fileUploadError: showErrorAlert});
            window.prettyPrint && prettyPrint();

        });
        function send() {
            document.getElementById('eventBody').value = document.getElementById("editor").innerHTML;
            return true;
        }
        function yahoomap() {
            if (document.getElementById('eventPlaceName').value == '') {
                alert('都道府県名と会場名を先に入力してください。');
            } else {
                document.getElementById('mapList').innerHTML = '';
                var placeName = document.getElementById('eventPlaceName').value;
                var pref = document.getElementById('eventPrefecture').value;
                var url = "<?php echo $this->Html->url(array("controller" => "tops","action" => "jsonYahooMap")); ?>/" + placeName + "/" + pref;
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $('#div1101').modal("show");
                        var prefList = [null, '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'];
                        document.getElementById('myModalLabel').innerHTML = prefList[pref] + 'から「' + placeName + '」の検索結果';
                        var len = data.length;
                        var insertLi = '';
                        for (var i = 0; i < len; i++) {
                            var src = '"javascript:' + "addressInput(" + data[i][1] + ",'" + data[i][2] + "')" + '";return false;';
                            insertLi = insertLi + '<li><a href="#map" onclick=' + src + ' class="thumbnail" style="margin-left:-20px;"><h5>' + data[i][0] + '</h5><p>' + data[i][2] + '</p></a></li>';
                            //$("#mapList").append("<li onclick=" + onclick + " >" + data[i][0] + "</li>");
                        }
                        document.getElementById('mapList').innerHTML = insertLi;
                    }
                })
            }
        }

        function addressInput(latitude, longitude, address) {
            document.getElementById('eventPlaceLatitude').value = latitude;
            document.getElementById('eventPlaceLongitude').value = longitude;
            document.getElementById('eventPlaceAddress').value = address;
            buttonpress();
            $('#div1101').modal('hide');
        }


        //]]>
    </script>
    <?php
    $pref = array(1 => '北海道', 2 => '青森県', 3 => '岩手県', 4 => '宮城県', 5 => '秋田県', 6 => '山形県', 7 => '福島県', 8 => '茨城県', 9 => '栃木県', 10 => '群馬県', 11 => '埼玉県', 12 => '千葉県', 13 => '東京都', 14 => '神奈川県', 15 => '新潟県', 16 => '富山県', 17 => '石川県', 18 => '福井県', 19 => '山梨県', 20 => '長野県', 21 => '岐阜県', 22 => '静岡県', 23 => '愛知県', 24 => '三重県', 25 => '滋賀県', 26 => '京都府', 27 => '大阪府', 28 => '兵庫県', 29 => '奈良県', 30 => '和歌山県', 31 => '鳥取県', 32 => '島根県', 33 => '岡山県', 34 => '広島県', 35 => '山口県', 36 => '徳島県', 37 => '香川県', 38 => '愛媛県', 39 => '高知県', 40 => '福岡県', 41 => '佐賀県', 42 => '長崎県', 43 => '熊本県', 44 => '大分県', 45 => '宮崎県', 46 => '鹿児島県', 47 => '沖縄県');
    $category = ['テストカテゴリ'];

    echo $this->Form->create('event', array('onSubmit' => 'return send()'));
    ?><hr><h5>タイトル</h5><?php
    echo $this->Form->text('name', array('style' => 'width:100%;', 'placeholder' => 'イベント名を入力してください'));
    ?><hr>
    <h5>イベント内容</h5>
    <!--ここからエディタ-->
    <div id="alerts"></div>
    <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
            <ul class="dropdown-menu">
            </ul>
        </div>
        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
            </ul>
        </div>
        <div class="btn-group">
            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
        </div>
        <div class="btn-group">
            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
        </div>
        <div class="btn-group">
            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
        </div>
        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
            <div class="dropdown-menu input-append">
                <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                <button class="btn" type="button">Add</button>
            </div>
            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

        </div>

        <div class="btn-group">
            <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
        </div>
        <div class="btn-group">
            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
        </div>
    </div>
    <?php echo $this->Form->hidden('body'); ?>
    <div id="editor">
    </div>
    <div class="alert alert-success">
        1MBまで入力可能です。
    </div>
    <!--ここまでエディタ-->
    <hr>
    <h5>イベントのタグ付け</h5>
    フォロワーが多いタグを入力するとより多くの人に情報を届けることが出来ます。
    <input type="text" name="tags" placeholder="フォロワーが多いタグを入力するとより多くの人がイベントを見ます。" id="taginput">
    <div class="alert">
        <strong>注意</strong><br>
        タグに半角括弧「( )」は使用できません。括弧より後ろ側が反映されません。<br>
        タグは10個まで入力可能です。
    </div>
    <hr>
    <h5>募集</h5>
    募集人数：<?php echo $this->Form->text('wanted', array('placeholder' => '募集人数')); ?>人　定員<?php echo $this->Form->text('wanted_max', array('placeholder' => '定員（任意）')); ?>人
    <hr>
    <h5>開催日時</h5>
    日付：<?php echo $this->Form->text('event_date', array('placeholder' => '開催日を入力してください')); ?><br>
    時刻；<div class="input-append bootstrap-timepicker">
        <?php echo $this->Form->text('event_time', array('placeholder' => '開始時刻を入力してください')); ?>
        <span class="add-on"><i class="icon-time"></i></span>
    </div>〜
    <div class="input-append bootstrap-timepicker">
        <?php echo $this->Form->text('event_end', array('placeholder' => '終了時刻を入力してください')); ?>
        <span class="add-on"><i class="icon-time"></i></span>
    </div>
    <hr>
    <h5>開催場所</h5>
    都道府県：<?php
    echo $this->Form->select('prefecture', $pref);
    ?><br>
    会場名：
    <?php
    echo $this->Form->text('place_name', array('placeholder' => '会場の名前を入れてください'));
    ?>
    <!-- モーダルボタン -->
    <a href="javascript:yahoomap();" role="button" class="btn btn-success" data-toggle="modal">会場名から検索</a>
    <div class="alert alert-success">
        飲食店、ランドマーク、名所などが会場の場合は、検索から自動で住所を入力することができます。
    </div>
    <hr>

    会場所在地：<?php
    echo $this->Form->text('place_address', array('placeholder' => '住所を入力してください。'));
    ?>
    <input type="button" class="btn" onclick="buttonpress()" value="住所から場所を検索" />
    <?php
    echo $this->Form->hidden('place_latitude');
    echo $this->Form->hidden('place_longitude');
    ?>
    <div id="map"></div>
    <div class="alert alert-success">
        ピンを動かして場所を調整できます。
    </div>
    <hr>
    <button type="submit" class="btn btn-large btn-primary">イベントを作成</button>
    <?php
    echo $this->Form->end();
    ?>
    </div>
</div>
<div class="span3">広告</div>


<!-- モーダルウィンドウ -->
<div id="div1101" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header"><!-- ヘッダ -->
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">検索</h3>
    </div>

    <div class="modal-body" style="max-height:300px;">
        <ul id="mapList" style="list-style:none"></ul>
    </div>

    <div class="modal-footer"><!-- フッタ -->
        <!-- Begin Yahoo! JAPAN Web Services Attribution Snippet -->
        <a href="http://developer.yahoo.co.jp/about">
            <img src="http://i.yimg.jp/images/yjdn/yjdn_attbtn1_125_17.gif" title="Webサービス by Yahoo! JAPAN" alt="Web Services by Yahoo! JAPAN" width="125" height="17" border="0" style="margin:15px 15px 15px 15px"></a>
        <!-- End Yahoo! JAPAN Web Services Attribution Snippet -->
        <button class="btn" data-dismiss="modal" aria-hidden="true">閉じる</button>
    </div>
</div>

<!--モーダル終わり-->
