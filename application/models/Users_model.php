<?php
	class Users_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function getAllCategories(){
			$q = "select id,name from categories order by name ASC";
			$query = $this->db->query($q);
			return $query->result();
		}
		public function getCategory(){
			$query = $this->db->get('categories');
			return $query;
		}	

		public function get_questions($id){	
			$query = "select get_questions_by_category('$id')";			
			$res = $this->db->query($query);
			return $res->result();
		}

	}
?>