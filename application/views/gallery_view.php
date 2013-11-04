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
            }

            #photos div{
                position: relative;
                display: block;
                width: 400px;
                height: 0;
                /*margin: 20px;*/
                border: 1px #666 solid;
                background-color: #222;
                background-size: cover;
                background-position: center center;
            }

            #photos div img {
                position: absolute;
                width: 400px;
                height: 400px;
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
                    $('<img src="<?php echo base_url();?>templates/leovative_twitter_tweet.png"/>').appendTo($frame);
                    $frame.prependTo($('#photos')).animate({'opacity':1, 'height':400, 'margin-bottom': '30px'}, 1500, function(){
                        cleanup();                        
                    });
                    

                });

                $img.attr('src',_url);
            }

            function cleanup(){
                var $photos = $('#photos');
                queue.shift();
                if($photos.children().length > 5 ){
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
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
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
