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
			$image_path = $this->composite_image->generate($_GET['image_url'], time(), $tag, 'twitter');

			//Send mail with attachment
			$this->send_mail->send($image_path[0]);

			//Retweet message to user
			$this->twitter->retweet($image_path[1], $_GET['screen_name']);
		}
		else{
			echo 'Invalid access';
		}
	}

}