<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">

        <style type="text/css">

            body{
                overflow: hidden;
                padding: 120px 0 0 0;
                margin:0;
                background:#eee url('<?= base_url(); ?>img/cfm_logo.png') no-repeat center 20px;
            }

            h3,h4{
                text-align: center;
                line-height: 16px;
            }

            h4{
                color: #DD3333;
            }

            #photos {
                width: 420px;
                margin: 0 auto;
            }

            #photos div{
                margin-right: 10px;
                margin-bottom: 10px;
                position: relative;
                display: inline-block;
                width: 400px;
                height: 0;
                /*margin: 20px;*/
                border: 1px #666 solid;
                background-color: #222;
                background-size: cover;
                background-position: center center;

            }

            #photos div img {
                width: 100%;
                height: 100%;
            }

        </style>

        <script src="<?php echo base_url();?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <script src="http://leo.dev:8080/socket.io/socket.io.js"></script>
        <script>

            //SOCKET STUFF

            // var socket = io.connect('http://leovative-leovative2013.rhcloud.com');
            var socket = io.connect('http://leo.dev:8080');
            socket.on('new_twit', function (img_url) {            
            // $('<img src="' + img_url + '"/>').prependTo($('body'));
            // $('#imgframe').attr('src', img_url);
                queue.push(img_url);
                if(!queProcess) loadQue();
            });


            //Animation stuff
            var queue = [];
            var queProcess = false;
            var lastFrame = null;


            function loadQue(){
                queProcess = true;
                var _url = queue[0];
                
                var $img = $('<img/>');

                

                $img.error(function(){
                    console.log('image is invalid');
                    cleanup();
                });

                $img.load(function(){
                    var $frame = $('<div/>').css({'opacity':0, 'background-image': 'url(' + _url + ')' });
                    $('<img src="<?php echo base_url();?>templates/twitter_tweet_template.png"/>').appendTo($frame);

                    $frame.prependTo($('#photos')).animate({'opacity':1, 'height':400, 'margin-bottom': '30px'}, 1500, function(){
                        cleanup();
                    });
                    if(lastFrame !=null) lastFrame.animate({'width':195, 'height':195}, 600);
                    lastFrame = $frame;

                });

                $img.attr('src',_url);
            }

            function cleanup(){
                var $photos = $('#photos');
                queue.shift();

                if($photos.children().length > 20 ){
                    $photos.children(':last').remove();
                }

                if(queue.length > 0){
                    loadQue();
                }
                else{
                    queProcess = false;
                }

            }


        </script>

    </head>
    <body>

        <h3>Twitter Photo Gallery</h3>
        <h4>#leovative #click3x</h4>
        <div id="photos"></div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="<?php echo base_url(); ?>js/vendor/bootstrap.min.js"></script>

        <script src="<?php echo base_url(); ?>js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>js/main.js"></script>

        <script>
            var _gaq=[['_setAccount','<?php echo GA_ACCOUNT; ?>'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
