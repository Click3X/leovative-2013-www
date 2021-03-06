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
         /*       overflow: hidden;*/
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
                position: relative;
                margin: auto;
                padding: 20px 0 0 10px;
                text-align: center;
            }

            #photos div.photo{
                margin-right: 0px;
                margin-bottom: 10px;
                position: relative;
                display: inline-block;
                width: 300px;
                border: 1px #666 solid;
                background-color: #222;
                background-size: cover;
                background-position: center center;
            }

            #photos div img {
                width: 100%;
            }

            div.play_button{
                width: 300px;
                height: 300px;
                background:rgba(255,0,0,0) url('../img/play.png') center center no-repeat;
                position: absolute;
                cursor: pointer;
                z-index: 2;
            }

            div.gif_holder{
                width: 300px;
                height: 300px;
                position: absolute;
                z-index: 1;
            }

            div.gif_holder img{
               width: 300px;
                height: 300px;
            }

            #photos div.photo.playing div.play_button{
                visibility: hidden;
            }

        </style>

        <script src="<?php echo base_url();?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <script type="text/javascript">
            var base_url = "<?php echo base_url();?>";
        </script>
 </head>
    <body>

        <h3>Twitter Photo Gallery</h3>
        <h4>#leovative #click3x</h4>
        <div id="photos">
            <?php  foreach ($images as $img): if (strpos($img, ".jpg") && strpos($img, "tweet")): 
                $src = base_url()."/export/".$img; 
                $start_id = strripos($img,"_")+1;
                $end_id = strpos($img, ".");
                $id = substr($img, $start_id, $end_id-$start_id ); 
                $gif_filename = "photobooth_".$id.".gif";
            ?>
            <div class="photo">
                <div class="play_button" data-gif-filename="<?= $gif_filename; ?>"></div>
                <div class="gif_holder"></div>
                <img src="<?= $src; ?>" />
            </div>
            <?php endif; endforeach; ?>
        </div>

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

