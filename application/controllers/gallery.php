<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function index($ext)
	{
		if(isset($ext)){
			

			$exportDir 	= getcwd() . "/export";
			$data 		= array(	"images" => scandir($exportDir),
									"ext"	=> $ext

							);

			$this->load->view('ext_view', $data);
		}else{

			$this->load->view('gallery_view');
		}
	}

}