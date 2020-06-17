<?php
	/**
	 * 
	 */
	class Quizz extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('quizz_model');
			$this->load->helper('url_helper');
		}

		public function createCle($value)
		{
			$alphabet = "azertyuiopqsdfghjkklmwxcvbnAZERTYUIOPLMKJHGFDSQWXCVBN1234567890";
			$length = strlen($alphabet);
			for ($i=0; $i < $value; $i++) 
			{ 
				$key = mt_rand(0, $length);
				$password = $password.''.$alphabet[$key];
			}
			return $password;
		}

		public function convertisseur($value)
    	{
    		$val_num = 0;
    		if ($value == 'zero') {
    			$val_num = 0;
    		}elseif ($value == 'un') {
    			$val_num = 1;
    		}elseif ($val_num == 'deux') {
    			$val_num = 2;
    		}elseif ($val_num == 'trois') {
    			$val_num = 3;
    		}elseif ($val_num == 'quatre') {
    			$val_num = 4;
    		}elseif ($val_num == 'cinq') {
    			$val_num = 5;
    		}elseif ($val_num == 'six') {
    			$val_num = 6;
    		}elseif ($val_num == 'sept') {
    			$val_num = 7;
    		}elseif ($val_num == 'huit') {
    			$val_num = 8;
    		}elseif ($val_num == 'neuf') {
    			$val_num = 9;
    		}
    		return $val_num;
    	}

		public function index()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('session');

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('time', 'Time', 'required');

			if ($this->form_validation->run() === FALSE) 
			{
				$head['title']='Création de quizz';
		    	$head['style']='style_login';
				$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/create_quizz');
				$this->load->view('quizz/templates/footer');
		    }
		    else
		    {
		    	$clef=$this->createCle(50);
		    	$title = $this->input->post('title');
		    	$time = $this->input->post('time');
		    	$id = $this->session->userdata('id');

		    	$data= array(
		    		'Clef'=>$clef,
		    		'Titre'=>$title,
		    		'Durée'=>$time,
		    		'user_id'=>$id
		    	);
		    	if ($this->quizz_model->create_quizz($data)) 
		    	{
		    		$head['title']='Aperçu';
		    		$head['style']='style_login';
			    	//$this->load->view('quizz/templates/header', $head);
			    	redirect('quizz/afficher/'.$clef.'');
			    	//$this->load->view('quizz/templates/footer');
		    	}
		    	else
		    	{
		    		show_404();
		    	}
		    }
		}

		public function create_question($clef)
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('text', 'Intitulé', 'required');
			$this->form_validation->set_rules('type', 'Type', 'required');
			$this->form_validation->set_rules('true[]', 'Vrai', 'required');
			$this->form_validation->set_rules('option[]', 'Options', 'required');
			
			if ($this->form_validation->run() === FALSE) 
			{
				$data['clef'] = $clef;
				$this->load->view('quizz/templates/quizz_header');
				$this->load->view('quizz/create_question', $data);
				$this->load->view('quizz/templates/footer');
		    }
		    else
		    {
		    	$intitule = $this->input->post('text');
		    	$type = $this->input->post('type');
		    	$reponses = $this->input->post('true');
		    	$options = $this->input->post('option[]');

		    	$question = array(
		    		'intitulé'=>$intitule,
		    		'Clef'=>$clef
		    	);
		    	$last_id = $this->quizz_model->insert_question($question);
		    	if ($last_id != 0) {
		    		$numero = $last_id;
		    	}

		    	$nb_option = count($options);
		    	for ($i=0; $i < $nb_option; $i++) { 
		    		$proposition = array(
			    		'intitulé'=>$options[$i],
			    		'numero_question'=>$numero,
			    		'type'=>$type
			    	);
			    	$this->quizz_model->insert_proposition($proposition);
		    	}

		    	$nb_reponse = count($reponses);
		    	for ($i=0; $i < $nb_reponse; $i++) {
		    		$num = $this->convertisseur($reponses[$i]); 
		    		$reponse = array(
			    		'texte'=>$options[$num],
			    		'numero_question'=>$numero,
			    	);
			    	$this->quizz_model->insert_reponse($reponse);
		    	}
		    	$head['title']='Aperçu';
		    	$head['style']='style_login';
		    	//$this->load->view('quizz/templates/header');
				redirect('quizz/afficher/'.$clef.'');
				//$this->load->view('quizz/templates/footer');
		    }
		}

		public function afficher($clef)
		{
			$quizz = $this->quizz_model->get_quizz($clef);
			$data['title'] = $quizz['Titre'];
			$question = $this->quizz_model->get_question($clef);
			$data['questions'] = $question;
			$data['nb_question'] = count($question);
			$data['clef'] = $clef;
			$head['title']='Aperçu';
		    $head['style']='style_login';
			$this->load->view('quizz/templates/header', $head);
			$this->load->view('quizz/view', $data);
			$this->load->view('quizz/templates/footer');
		}

		public function quizz_list($user_id)
		{
			$this->load->library('session');
			$id = $this->session->userdata('id');
			$user_info = $this->quizz_model->get_user_info($id);
			if (count($this->quizz_model->get_all_quizz($id)) == 0) {
				$head['title']='Dashbord';
			    $head['style']='style_login';
				$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/view', $data);
				$this->load->view('quizz/templates/footer');
			}
			else
			{
				$quizzs = $this->quizz_model->get_all_quizz($id);
				$data['quizzs']=$quizzs;
				$head['title']='Dashbord';
			    $head['style']='style_login';
				$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/view', $data);
				$this->load->view('quizz/templates/footer');
			}
		}

		public function verifier_quizz()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('nom', 'Nom', 'required');
		    $this->form_validation->set_rules('prenom', 'Prenom', 'required');
			$this->form_validation->set_rules('clef', 'Clef', 'required');
			
			if ($this->form_validation->run() === FALSE) 
			{
				$this->load->view('quizz/templates/header');
				$this->load->view('quizz/macth',$data);
				$this->load->view('quizz/templates/footer');
			}else
			{
				$clef = $this->input->post('text');
				$quizz = $this->quizz_model->get_quizz($clef);
				if ($quizz['Statut'] =! 'Actif') {
					$data['msg'] = 'Ce quizz est indisponible pour le moment. Pour plus d\'info, veuillez contater le créateur du quizz.';
					$this->load->view('quizz/templates/header');
					$this->load->view('quizz/macth',$data);
					$this->load->view('quizz/templates/footer');
				}
				else
				{
					$nom  = $this->input->post('nom');
					$prenom = $this->input->post('prenom');
					$student=array(
						'nom'=>$nom,
						'prenom'=>$prenom
					);
					$this->quizz_model->insert_student($reponse);
					$id = $this->quizz_model->get_id($nom, $prenom);
					$participation = array(
						'student_id'=>$id
					);
				}
			}
		}

		public function participer($clef)
		{
			$questions = $this->quizz_model->get_question($clef);
			$i = 1;
			$this->load->view('quizz/templates/quizz_header');
			foreach ($questions as $question) {
				$this->load->helper('form');
				$this->load->library('form_validation');

				$this->form_validation->set_rules('true[]', 'Reponse', 'required');
				$num = $question['numero'];
				$option = $this->quizz_model->get_option($num);
				$data['i'] = $i;
				$data['clef'] = $clef;
				$data['question'] = $question;
				$data['options'] = $option;
				if ($this->form_validation->run() === FALSE) 
				{
					$this->load->view('quizz/repondre_quizz', $data);
			    }
			    else
			    {
			    	$rep_soumise = $this->input->post('true');
			    	$data = array(
			    		'rep_soumise'=>$rep_soumise
			    	);
			    	$reponses = $this->quizz_model->get_reponse($num); 
			    	print_r($data);
			    	print_r($reponses);
			    	die();
			    }
			    $i++;
			}
			$this->load->view('quizz/templates/footer');
		}

		public function change_quizz_state($clef, $etat)
		{
			$data = array(
				'Statut'=>$etat
			);
			if ($this->quizz_model->change_state($clef, $data)) 
		    {
		    	return true;
		    }else
		    	return false;
		}

		public function supprimer_quizz($clef)
		{
			if ($this->quizz_model->delete_quizz($clef)) 
		    {
		    	return true;
		    }else
		    	return false;
		}

		public function supprimer_question($num)
		{
			if ($this->quizz_model->delete_question($num)) 
		    {
		    	return true;
		    }else
		    	return false;
		}

		public function valider()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('true[]', 'Vrai', 'required');
			
			if ($this->form_validation->run() === FALSE) 
			{

			}
		}

		public function correction($clef)
		{

			$questions = $this->quizz_model->get_question($clef);
			$i = 1;
			$head['title']='Correction du quizz';
		    $head['style']='style_quizzcorrection';
			$this->load->view('quizz/templates/header', $head);
			foreach ($questions as $question) {
				$num = $question['numero'];
				$option = $this->quizz_model->get_option($num);
				$data['i'] = $i;
				$data['clef'] = $clef;
				$data['questions'] = $questions;
				$data['options'] = $option;
				$this->load->view('quizz/view_correct', $data);
			    $i++;
			}
			$this->load->view('quizz/view_correct', $data);
			$this->load->view('quizz/templates/footer');
		}
	}