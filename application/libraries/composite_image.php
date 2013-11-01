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
			$name 		= 'temp_' . time() .".jpg";
			$filepath 	= config_item('export_url') . $name;
			
			// Save image to server
			$img = imagecreatefromstring(base64_decode($data['base64data']));
			ob_start(); 
			imagejpeg($img, null, 80);
			$output = ob_get_contents(); 
			ob_end_clean ();
			file_put_contents( $filepath , $output );
			unset($img);
			unset($output);

			//composite photo with template
			$image_path = $this->generate($filepath, time(), $data['tag']);
			
			// //Delete temporary file
			unlink($filepath);
			return $image_path;
		}
		else{
			echo 'No data passed';
		}
	}

	public function generate( $image, $created_time, $tag)
	{					
		$img_length 		= 520; //Width and height
		$img_padding		= 40;  //source image xy padding
		$offset				= array('x'=>0,'y'=>0);
		$file_folder		= 'export/';	
		$name 				= $tag. '_' . $created_time.".jpg";
		$save_location 		= $file_folder . $name;

		// Set a min height and width
		$w  = $img_length;
		$h  = $img_length;

		// Get new dimensions
		list($o_w, $o_h) = getimagesize($image);

		$o_ratio = $o_w/$o_h;

		if ($w/$h < $o_ratio) {
		   $w = $h * $o_ratio;
		} else {
		   $h = $w / $o_ratio;
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

		$canvas = imagecreatetruecolor($img_length, $img_length);

		//Calculate offset value
		if($o_ratio > 1){
			//Landscape
			$offset['x'] = -($w - $img_length)/2;
		}
		else if($o_ratio < 1){
			//Portrait
			$offset['y'] = -($h - $img_length)/2;
		}

		imagecopyresampled($canvas, $src_img, $offset['x'], $offset['y'],0, 0, $w, $h, $o_w, $o_h);
		$tpl_img = imagecreatefromjpeg( base_url() . config_item('template_url').$tag.'.jpg' );

		//merge
		imagecopyresized($tpl_img, $canvas,$img_padding, $img_padding,0,0, imagesx($canvas),imagesy($canvas),imagesx($canvas),imagesy($canvas) );

		//save image to folder
		imagejpeg($tpl_img, $save_location);
		imagedestroy($src_img);
		imagedestroy($tpl_img);		
		return $save_location;		
	}	

}
