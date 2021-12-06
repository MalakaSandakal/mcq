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

	// admin home page (questions page)
	public function home(){
		$this->load->library('session');
		if($this->session->userdata('user')){
			$this->load->view('home');
		}
		else{
			redirect('admin');
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
    public function addQuestions(){
        $this->load->library('session');
		if($this->session->userdata('user')){
			$this->load->view('addQuestion');
		}
		else{
			redirect('admin');
		}
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





	public function ajax(){
		$this->load->view('ajax');		
	}

	public function ajax_(){
		$data = array(
			'username' => $this->input->post('name'),
			'pwd'=>$this->input->post('pwd')
		);
		echo json_encode($data['username']);
	}
}