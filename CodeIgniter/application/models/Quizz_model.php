<?php
	/**
	 * 
	 */
	class Quizz_model extends CI_Model
	{
		
		function __construct()
		{
			$this->load->database();
		}

		public function create_quizz($data)
		{
			return $this->db->insert('qcm', $data);
		}

		public function insert_question($question)
		{
			if ($this->db->insert('question', $question)) {
				return $this->db->insert_id();
			}else
				return 0;
		}

		public function get_user_info($id)
		{
			$query = $this->db->get_where('users', array('user_id'=>$id));
			return $query->row_array();
		}

		public function insert_proposition($proposition)
		{
			return $this->db->insert('proposition', $proposition);
		}

		public function insert_reponse($reponse)
		{
			return $this->db->insert('reponse', $reponse);
		}

		public function get_question($clef)
		{
			$this->db->select('numero, intitulé');
			$this->db->from('question');
			$this->db->join('qcm', 'question.Clef = qcm.Clef');
			$this->db->where('question.Clef', $clef);
			$this->db->order_by('numero', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_option($num)
		{
			$this->db->select('intitulé, type');
			$this->db->from('proposition');
			$this->db->where('numero_question', $num);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_reponse($num)
		{
			$this->db->select('texte');
			$this->db->from('reponse');
			$this->db->where('numero_question', $num);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_quizz($clef)
		{
			$query = $this->db->get_where('qcm', array('Clef'=>$clef));
			return $query->row_array();
		}

		public function get_all_quizz($user_id)
		{
			$this->db->select('*');
			$this->db->from('qcm');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function change_state($clef, $data)
		{
			$this->db->where('Clef', $clef);
			return $this->db->update('qcm', $data);
		}

		public function delete_quizz($clef)
		{
			return $this->db->delete('qcm', array('Clef' => $clef));
		}

		public function delete_question($num)
		{
			return $this->db->delete('question', array('numero' => $num));
		}

		public function insert_student($data)
		{
			return $this->db->insert('students', $data);
		}

		public function get_id($nom, $prenom)
		{
			$this->db->select('student_id');
			$this->db->from('students');
			$this->db->where('nom', $nom);
			$this->db->where('prenom', $prenom);
			$query = $this->db->get();
			return $query->row_array();
		}

		public function partcicipe($data)
		{
			return $this->db->insert('participation', $data);
		}

		public function get_student_info($clef)
		{
			$this->db->select('nom, prenom, *');
			$this->db->from('participation');
			$this->db->join('students', 'participation.student_id = students.student_id');
			$this->db->where('clef_reponse', $clef);
			$query = $this->db->get();
			return $query->result_array();
		}
	}