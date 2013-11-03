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
			$name 		= 'temp_' . time() .".png";
			$filepath 	= config_item('export_url') . $name;
			
			// Save image to server
			$imgdata = base64_decode($data['base64data']);

			file_put_contents($filepath, $imgdata);
			unset($imgdata);

			//composite photo with template
			$image_path = $this->generate($filepath, time(), $data['tag']);
			
			// //Delete temporary file
			//unlink($filepath);
			return $image_path;
		}
		else{
			echo 'No data passed';
		}
	}

	public function generate( $image, $created_time, $tag)
	{					
		$img_length 		= 560; //Width and height
		$img_padding		= 20;  //source image xy padding
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

		//resize src image
		$resized_src_img = imagecreatetruecolor($img_length, $img_length);
		imagecopyresampled($resized_src_img, $src_img, $offset['x'], $offset['y'],0, 0, $w, $h, $o_w, $o_h);

		//load template image
		$tpl_img = imagecreatefrompng( base_url() . config_item('template_url').$tag.'.png' );

		//create base image to plop everythin into
		$base = imagecreatetruecolor( imagesx($tpl_img), imagesy($tpl_img) );

		//merge resized src into base
		imagecopymerge( $base , $resized_src_img , $img_padding , 155 , 0 , 0 , imagesx($resized_src_img), imagesy($resized_src_img), 100);

		//merge template into base
		imagecopyresampled($base , $tpl_img,0,0,0,0, imagesx($tpl_img), imagesy($tpl_img),imagesx($tpl_img), imagesy($tpl_img));

		//save image to folder
		header('Content-Type: image/jpg');
		imagejpeg($base, $save_location);

		//kill stuff
		imagedestroy($base);
		imagedestroy($src_img);
		imagedestroy($tpl_img);		

		//return file location
		return $save_location;		
	}	

}
