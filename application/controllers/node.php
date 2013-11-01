<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Node extends CI_Controller {

	public function index()
	{
		echo '<p>This is node.js linstener controller</p>';
	}

	public function twitterNodeListener(){
		if(isset($_GET['screen_name']) && isset($_GET['tag']) && isset($_GET['image_url'])){
			
			//Tag can be multiple value. 
			//Split them and use the first value for now.
			$tags = explode(',', $_GET['tag']) ;
			$tag  =$tags[0];

			//Composite image and get a image path
			$image_path = $this->composite_image->photo($_GET['image_url']);

			//Send mail with attachment
			$this->send_mail->send($image_path);

			//Retweet message to user
			$this->twitter->retweet($image_path, $_GET['screen_name']);
		}
		else{
			echo 'Invalid access';
		}
	}

}