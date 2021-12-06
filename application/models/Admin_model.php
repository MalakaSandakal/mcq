<?php
	class Admin_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
 
		public function login($username, $password){
			$query = $this->db->get_where('users', array('username'=>$username, 'password'=>$password));
			return $query->row_array();
		}


		// -- Categories
		public function addCategory($name)
		{
			$query="insert into categories(name) values('$name')";
			$this->db->query($query);
		}
        
		public function viewCategory(){
			$q = "select id,name from categories";
			$query = $this->db->query($q);
			return $query->result();
		}

		public function editCategory($id){
			$query = $this->db->get_where('categories',['id' => $id]);
			return $query->row();
		}
        
		public function updateCategory($data, $id){
			return $this->db->update('categories', $data, ['id'=>$id]);
		}

		public function deleteCategory($id){
			return $this->db->delete('categories',['id'=>$id]);
		}
 
	}
?>