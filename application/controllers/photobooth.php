<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photobooth extends CI_Controller {

	public function index()
	{
		$this->load->view('photobooth_view');
	}

	public function save()
	{
		/* ------------------------------------------------
		| POSTDATA should contain these variables:
		| base64data (b64 binary)
		| screenname (twitter account)
		| tag        (twitter hashtag)
		|--------------------------------------------------*/

		$data = $this->input->post();

		//Composite image and get a image path
		$image_path = $this->composite_image->base64($data);

		//Send mail with attachment
		$this->send_mail->send($image_path);

		//Retweet message to user
		//$this->twitter->retweet($image_path, $data['screenname']);
	}
}
