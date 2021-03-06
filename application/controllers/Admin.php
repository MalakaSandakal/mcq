<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
	}

	
	/*
		****
			Admin login and index functions
		****
	*/

	// display login page before loginto admin
	public function index(){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$this->load->view('login_page');
		}
		else{
			$this->load->view('login_page');
		}
	}

	// login to admin
	public function login(){
		$this->load->library('session');
 
		$username = $_POST['username'];
		$password = $_POST['password'];
 
		$data = $this->admin_model->login($username, $password);
 
		if($data){
			$this->session->set_userdata('user', $data);
			redirect('admin/questions');
		}
		else{
			$this->session->set_flashdata('error','Invalid login. User not found');
		} 
	} 
	
	// logout
	public function logout(){
		$this->load->library('session');
		$this->session->unset_userdata('user');
		redirect('admin');
	}	


	/*
		****
			Category functions (View, Update, Delete)
		****
	*/

	// display categories in category page
    public function categories(){
		$this->load->library('session');
		if($this->session->userdata('user')){			
			$data['category'] = $this->admin_model->viewCategory();
			$this->load->view('Admin/categories/categories',$data);
		}
		else{
			redirect('admin');
		} 
	}

	// add new categories
	public function addCategories(){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$this->load->view('Admin/categories/addCategory');

			if($this->input->post('save'))
			{
				$n=$this->input->post('name');	
				if(empty($n)){
					echo "record empty";
				}else{
					$this->admin_model->addCategory($n);		
					echo "Records Saved Successfully";
					redirect('admin/Categories');
				}			
			}
			}
		else{
			redirect('admin');
		}
	}

	// open category edit form 
	public function editCategories($id){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$data['category']=	$this->admin_model->editCategory($id);
			$this->load->view('Admin/categories/editCategory',$data);
		}
		else{
			redirect('admin');
		}
	}
	
	// update category in db after edit
	public function updateCategories($id){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$data = [
				'name'=> $this->input->post('name')	
			];
			$this->admin_model->updateCategory($data, $id);
			redirect('admin/Categories');
		}
		else{
			redirect('admin');
		}
	} 

	// delete category
	public function deleteCategories($id){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$this->admin_model->deleteCategory($id);
			redirect('admin/Categories');
		}
		else{
			redirect('admin');
		}
	} 

	
	// admin home page (questions page)
	public function home(){
		$this->load->library('session');
		if($this->session->userdata('user')){

			$data['question'] = $this->admin_model->viewQuestions();		
			$this->load->view('Admin/questions/questions', $data);
		}
		else{
			redirect('admin');
		}
 
	}	
	
    public function addQuestions(){
        $this->load->library('session');
		if($this->session->userdata('user')){
			$data['category'] = $this->admin_model->getCategory();
			$this->load->view('Admin/questions/addQuestion',$data);
		}
		else{
			redirect('admin');
		}
    }

	public function add_q(){	
		$body = $this->input->post();
		$json_data = json_encode($body);
		$this->admin_model->addQuestions($json_data); 
	}

	public function update_q($id_){
		// $question_id  = $this->input->post('question_id');
		$body = $this->input->post();
		$json_data = json_encode($body);
		$this->admin_model->updateQuestions($id_, $json_data); 
	}

	public function view_edit_page($id){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$data['category'] = $this->admin_model->getCategory();
			$data['id'] = $id;
			$this->load->view('Admin/questions/editQuestion',$data);
		}
		else{
			redirect('admin');
		}
	}

	public function getq_($id){		
		$quest_data =$this->admin_model->editQuestion($id);
		$encoded = json_encode($quest_data[0]);
		echo $encoded;
	}

	public function deleteQuestions($id){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$this->admin_model->deleteQuestion($id);
			redirect('admin/questions');
		}
		else{
			redirect('admin');
		}
	} 
}