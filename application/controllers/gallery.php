<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function index($ext)
	{
		$this->load->view('gallery_view');
	}

	public function all(){
		$exportDir 	= getcwd() . "/export";
		$data 		= array( "images" => scandir( $exportDir ) );

		$this->load->view('ext_view', $data);
	}
}