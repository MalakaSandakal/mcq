<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		// $this->load->model('user_model');
	}

	public function index(){
		$this->load->view('Users/allcategories');
	}  

	public function  allcategories(){
		$this->load->view('Users/allcategories');
	}
}