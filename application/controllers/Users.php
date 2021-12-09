<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('users_model');
	}

	public function index(){
		$data['category'] = $this->users_model->getAllCategories();
		$this->load->view('Users/allcategories',$data);
	}  
	
	public function viewQuestions($id){

		$data['id'] = $id;		

		$json = $this->users_model->get_questions($id);

		print_r(json_encode($json));

		$data['encode']= $json;

		$this->load->view('Users/questions',$data);

	}
}