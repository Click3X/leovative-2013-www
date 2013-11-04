<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Composite_Image
{
  protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
	}

	public function base64($data = null)
	{
		if(!empty($data)){
		
			$ts = time();
			$pngname 		= 'photobooth_' . $ts .".png";
			$png_filepath 	= config_item('export_url') . $pngname;

			$gifname 		= 'photobooth_' . $ts .".gif";
			$gif_filepath 	= config_item('export_url') . $gifname;
			
			// Save photobooth image to server
			$imgdata = base64_decode($data['base64data']);
			file_put_contents($png_filepath, $imgdata);
			unset($imgdata);
			
			//Create GIF
			$frames;
			$framed;
			$image   = imagecreatefrompng($png_filepath);
			$num_img = 0;
			
			while ($num_img < 4) {			
				$x = -($num_img%2) * 512;
				$y = ($num_img>=2) ? -512:0;
				$block = imagecreatetruecolor(500, 500);
				imagecopyresampled($block, $image, $x, $y, 0, 0, imagesx($image), imagesy($image), imagesx($image), imagesy($image));
				ob_start();
				imagegif($block);
				$frames[]=ob_get_contents();
				$framed[]=20;
				ob_end_clean();
				$num_img++;
			}

			// Generate the animated gif and output to screen.
			include('./GIFEncoder.class.php');
			$gif = new GIFEncoder($frames,$framed,0,2,0,0,0,'bin');
			file_put_contents($gif_filepath, $gif->GetAnimation());

			//composite photo with template
			$image_path = $this->generate($png_filepath, $ts, $data['tag'], 'photobooth');

			$image_path[2] = $gif_filepath;
			return $image_path;
		}
		else{
			echo 'No data passed';
		}
	}

	public function generate( $image, $created_time, $tag, $type)
	{					
		$print_img_length 			= 560; //Width and height
		$print_img_padding			= 20;  //source image xy padding

		$tweet_img_length 			= 600; //Width and height

		$offset						= array('x'=>0,'y'=>0);
		$file_folder				= 'export/';	
		
		$print_filename 			= $tag. '_' . $type . '_print_' . $created_time.".jpg";
		$print_save_location 		= $file_folder . $print_filename;

		$tweet_filename 			= $tag. '_' . $type . '_tweet_' . $created_time.".jpg";
		$tweet_save_location 		= $file_folder . $tweet_filename;

		// Set a min height and width
		$w  = $print_img_length;
		$h  = $print_img_length;

		// Get new dimensions
		list($o_w, $o_h) = getimagesize($image);

		$o_ratio = $o_w/$o_h;

		if ($w/$h < $o_ratio) {
		   $w = $h * $o_ratio;
		} else {
		   $h = $w / $o_ratio;
		}

		//Calculate offset value
		if($o_ratio > 1){
			//Landscape
			$offset['x'] = -($w - $print_img_length)/2;
		}
		else if($o_ratio < 1){
			//Portrait
			$offset['y'] = -($h - $print_img_length)/2;
		}

		//Create image by file extension and resmaple
		$extension 			= strtolower(end(explode(".", $image)));
		switch( $extension ) {
			case 'jpg':
			case 'jpeg':
			$src_img 		= imagecreatefromjpeg( $image );
		 	break;
			case 'gif':
		 	$src_img 		= imagecreatefromgif( $image );
		 	break;
			case 'png':
		 	$src_img 		= imagecreatefrompng( $image );
		 	break;
		}


		//PRINT PART

		//resize src image
		$resized_src_img = imagecreatetruecolor($print_img_length, $print_img_length);
		imagecopyresampled($resized_src_img, $src_img, $offset['x'], $offset['y'],0, 0, $w, $h, $o_w, $o_h);

		//load template image
		$print_tpl_img = imagecreatefrompng( base_url() . config_item('template_url') . $tag . '_' . $type . '_print.png' );

		//create base image to plop everythin into
		$base = imagecreatetruecolor( imagesx($print_tpl_img), imagesy($print_tpl_img) );

		//merge resized src into base
		imagecopymerge( $base , $resized_src_img , $print_img_padding , 155 , 0 , 0 , imagesx($resized_src_img), imagesy($resized_src_img), 100);

		//merge template into base
		imagecopyresampled($base , $print_tpl_img,0,0,0,0, imagesx($print_tpl_img), imagesy($print_tpl_img),imagesx($print_tpl_img), imagesy($print_tpl_img));

		//save image to folder
		header('Content-Type: image/jpg');
		imagejpeg($base, $print_save_location);


		//TWITTER PART

		//get offset diff
		$diff = $tweet_img_length / $print_img_length;

		//load template image
		$tweet_tpl_img = imagecreatefrompng( base_url() . config_item('template_url') . $tag . '_' . $type . '_tweet.png' );

		//resize src image
		$base = imagecreatetruecolor($tweet_img_length, $tweet_img_length);
		imagecopyresampled($base, $src_img, $offset['x']*$diff, $offset['y']*$diff,0, 0, $w*$diff, $h*$diff, $o_w, $o_h);
		
		//merge template into base
		imagecopyresampled($base , $tweet_tpl_img,0,0,0,0, imagesx($tweet_tpl_img), imagesy($tweet_tpl_img),imagesx($tweet_tpl_img), imagesy($tweet_tpl_img));

		//save image to folder
		header('Content-Type: image/jpg');
		imagejpeg($base, $tweet_save_location);


		//kill stuff
		imagedestroy($base);
		imagedestroy($src_img);
		imagedestroy($print_tpl_img);
		imagedestroy($tweet_tpl_img);
		unlink($image);

		//return file location
		$result[0] = $print_save_location;
		$result[1] = $tweet_save_location;

		return $result;
	}	

}
