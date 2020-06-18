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
			$password='';
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
			    	redirect('quizz/afficher/'.$clef.'');
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
				redirect('quizz/afficher/'.$clef.'');
		    }
		}

		public function afficher($clef)
		{
			$this->load->library('session');
			$id = $this->session->userdata('id');
			$this->session->set_userdata('clef', 'clef');
			$quizz = $this->quizz_model->get_quizz($clef);
			$data['title'] = $quizz[0]['Titre'];
			$question = $this->quizz_model->get_question($clef);
			$data['questions'] = $question;
			$data['nb_question'] = count($question);
			$data['clef'] = $clef;
			$data['id'] = $id;
			$head['title']='Affichage des questions';
		    $head['style']='style_modif';
			$this->load->view('quizz/templates/dash_header', $head);
			$this->load->view('quizz/view', $data);
		}

		public function quizz_list()
		{
			$this->load->library('session');
			$id = $this->session->userdata('id');
			$user_info = $this->quizz_model->get_user_info($id);
			$quizzs = $this->quizz_model->get_all_quizz($id);
			if (count($this->quizz_model->get_all_quizz($id)) == 0) {
			    $data['msg']='Vous n\'avez aucun quizz acctuellement, cliquez sur le bouton "Nouveau quizz" pour en créer un!';
			}
			else
			{
			    $data['msg']=' ';
			}
			$data['quizzs']=$quizzs;
		    $data['user']=$user_info;
		    $head['title']='Tableau de bord';
	    	$head['style']='style_dash';
			$this->load->view('quizz/templates/dash_header', $head);
			$this->load->view('quizz/dashbord', $data);
			/*else
			{
				redirect('connect/index');
			}*/
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
				$data['msg'] = ' ';
				$head['title']='Rejoindre quizz';
				$head['style']='style_elevelogin';
				$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/student_sign',$data);
				$this->load->view('quizz/templates/footer');
			}
			else
			{
				$clef = $this->input->post('clef');
				$quizz = $this->quizz_model->get_quizz($clef);
				if (count($quizz) != 0) {
					if ($quizz[0]['Statut'] != 'Actif') {
						$data['msg']='Ce quizz est indisponible pour le moment.';
						$head['title']='Rejoindre quizz';
						$head['style']='style_elevelogin';
						$this->load->view('quizz/templates/header', $head);
						$this->load->view('quizz/student_sign',$data);
						$this->load->view('quizz/templates/footer');
					}
					else
					{
						$nom  = $this->input->post('nom');
						$prenom = $this->input->post('prenom');
						$id_verif = $this->quizz_model->get_id($nom, $prenom);
						if (count($this->quizz_model->verif_doublon($id_verif)) != 0) {
							$data['msg']='Vous avez déjà participer à ce quizz.';
							$head['title']='Rejoindre quizz';
							$head['style']='style_elevelogin';
							$this->load->view('quizz/templates/header', $head);
							$this->load->view('quizz/student_sign',$data);
							$this->load->view('quizz/templates/footer');
						}
						else
						{
							$student=array(
							'nom'=>$nom,
							'prenom'=>$prenom
							);
							$this->quizz_model->insert_student($student);
							$id = $this->quizz_model->get_id($nom, $prenom);
							$clef_rep=$this->createCle(45);
							$participation = array(
								'student_id'=>$id['student_id'],
								'clef_qcm'=>$clef,
								'note'=>NULL,
								'clef_reponse'=>$clef_rep
							);
							$this->quizz_model->participer($participation);
							redirect('quizz/participer/'.$clef.'');
						}
					}					
				}
				else
				{
					$data['msg']='Ce quizz n\'existe pas. Veuillez vérifier si vous aviez bien copié la clé.';
					$head['title']='Rejoindre quizz';
					$head['style']='style_elevelogin';
					$this->load->view('quizz/templates/header', $head);
					$this->load->view('quizz/student_sign',$data);
					$this->load->view('quizz/templates/footer');
				}
			}
		}

		public function participer($clef)
		{
			$questions = $this->quizz_model->get_question($clef);
			$quizz = $this->quizz_model->get_quizz($clef);
			$i = 1;
			$head['title']='Participation du quizz';
			$head['style']='style_elevequizz';
			$head['time']=$quizz[0]['Durée'];
			$this->load->view('quizz/templates/eleve_header', $head);
			foreach ($questions as $question) {
				$this->load->helper('form');
				$this->load->library('form_validation');

				$this->form_validation->set_rules('true[]', 'Reponse', 'required');
				$num = $question['numero'];
				$option = $this->quizz_model->get_option($num);
				$quizz = $this->quizz_model->get_quizz($clef);
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
					print_r($reponses);
			    	die(); 
			    }
			    $i++;
			}
			$this->load->view('quizz/templates/eleve_footer');
		}

		public function change_quizz_state($clef, $etat)
		{
			$this->load->library('session');
			$id = $this->session->userdata('id');
			$data = array(
				'Statut'=>$etat
			);
			if ($this->quizz_model->change_state($clef, $data)) 
		    {
		    	redirect('quizz/quizz_list/');
		    }
		}

		public function supprimer_quizz($clef)
		{
			$this->load->library('session');
			$id = $this->session->userdata('id');
			if ($this->quizz_model->delete_quizz($clef)) 
		    {
		    	redirect('quizz/quizz_list/');
		    }
		}

		public function supprimer_question($num)
		{
			$this->load->library('session');
			$clef = $this->session->userdata('clef');
			if ($this->quizz_model->delete_question($num)) 
		    {
		    	redirect('quizz/afficher/'.$clef.'');
		    }
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

		public function correction($clef_rep)
		{
			$correct = $this->quizz_model->get_correction($clef_rep);
			$clef_qcm = $correct[0]['clef_qcm'];
			$questions = $this->quizz_model->get_question($clef_qcm);
			$i = 1;
			$this->load->view('quizz/templates/correction_header');
			foreach ($questions as $question) {
				$num = $question['numero'];
				$option = $this->quizz_model->get_option($num);
				$reponses = $this->quizz_model->get_reponse($num);
				$data['i'] = $i;
				$data['clef'] = $clef_qcm;
				$data['question'] = $question;
				$data['options'] = $option;
				$data['reponses'] = $reponses;
				$data['nb'] = count($option);
				$this->load->view('quizz/view_correct', $data);
			    $i++;
			}
			$this->load->view('quizz/templates/correction_footer');
		}

		public function statistique($clef)
		{
			$this->load->library('session');
			$id = $this->session->userdata('id');
			$quizz = $this->quizz_model->get_quizz($clef);
			$data['title'] = $quizz[0]['Titre'];
			$stats = $this->quizz_model->get_statistique($clef);
			if (count($stats) == 0) {
				$data['msg'] = 'Vous n\'avez aucun participant pour le moment.';
			}
			else
			{
				$data['msg'] = ' ';
			}
			$data['stats'] = $stats;
			$data['id'] = $id;
			$head['title']='Statistique';
			$head['style']='style_statistiques';
			$this->load->view('quizz/templates/dash_header', $head);
			$this->load->view('quizz/stats', $data);
		}

		public function acces_correction()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('clef', 'Clef', 'required');
			
			if ($this->form_validation->run() === FALSE) 
			{
				$data['msg'] = ' ';
				$head['title']='Rejoindre la correction d\'un quizz';
				$head['style']='style_elevelogin';
				$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/correction_sign',$data);
				$this->load->view('quizz/templates/footer');
			}
			else
			{
				$clef = $this->input->post('clef');
				$correct = $this->quizz_model->get_correction($clef);
				if (count($correct) != 0) {
					redirect('quizz/correction/'.$clef.'');
				}
				else
				{
					$data['msg'] = 'Veuillez vérifier que vous aviez bien copié votre clé personnelle.';
					$head['title']='Rejoindre quizz';
					$head['style']='style_elevelogin';
					$this->load->view('quizz/templates/header', $head);
					$this->load->view('quizz/correction_sign',$data);
					$this->load->view('quizz/templates/footer');
				}

			}
		}
	}