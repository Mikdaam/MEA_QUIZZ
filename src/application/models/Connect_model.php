<?php
	/**
	 * 
	 */
	class Connect_model extends CI_Model
	{
		
		function __construct()
		{
			$this->load->database();
		}

		public function set_user($data)
		{
			return $this->db->insert('users', $data);
		}

		public function get_user($mail)
		{
			$query = $this->db->get_where('users', array('email'=>$mail));
			return $query->row_array();
		}
		
		public function set_student($data)
		{
			return $this->db->insert('students', $data);
		}

		public function get_student($id)
		{
			$query = $this->db->get_where('students', array('student_id'=>$id));
			return $query->row_array();
		}

		public function update_pass($mail, $data)
		{
			$this->db->where('email', $mail);
			return $this->db->update('users', $data);
		}

	}