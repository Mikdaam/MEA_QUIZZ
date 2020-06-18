<?php
	/**
	 * 
	 */
	class Connect extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('connect_model');
			$this->load->helper('url_helper');
		}
		
		public function index()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('session');

			$this->form_validation->set_rules('mail', 'Email', 'required');
		    $this->form_validation->set_rules('password', 'Mot de passe', 'required');

		    if ($this->form_validation->run() === FALSE) {
		    	$data['msg']=' ';
		    	$head['title']='Connexion';
		    	$head['style']='style_login';
		    	$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/index', $data);
				$this->load->view('quizz/templates/footer');
		    }
		    else {
		    	$email = $this->input->post('mail');
		    	$password = $this->input->post('password');
		    	$data = $this->connect_model->get_user($email);
		    	if (password_verify($password, $data['password'])) {
		    		$newdata = array(
		    			'id'=>$data['user_id'],
				        'nom'=>$data['nom'],
				        'prenom'=>$data['prenom'],
				        'logged_in' => TRUE
					);
					$this->session->set_userdata($newdata);
		    		redirect('quizz/quizz_list/');
		    	}
		    	else
		    	{
		    		$data['msg']='Email ou mot de passe incorrect.';
		    		$head['title']='Connexion';
		    		$head['style']='style_login';
		    		$this->load->view('quizz/templates/header', $head);
					$this->load->view('quizz/index', $data);
					$this->load->view('quizz/templates/footer');
		    	}
		    }

		}

		public function create_user()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('nom', 'Nom', 'required');
			$this->form_validation->set_rules('prenom', 'Prenom', 'required');
			$this->form_validation->set_rules('mail', 'Email', 'valid_email|is_unique[users.email]');
		    $this->form_validation->set_rules('password', 'Mot de passe', 'required');

		    $this->form_validation->set_message('is_unique', 'Cet {field} est déjà utilisé.');

		    if ($this->form_validation->run() === FALSE) {
		    	$head['title']='Inscription';
		    	$head['style']='style_login';
				$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/sign');
				$this->load->view('quizz/templates/footer');
		    }
		    else {
		    	$nom = $this->input->post('nom');
		    	$prenom = $this->input->post('prenom');
		    	$email = $this->input->post('mail');
		    	$password = $this->input->post('password');

		    	$data=array(
					'nom'=>$nom,
					'prenom'=>$prenom,
					'email'=>$email,
					'password'=>password_hash($password, PASSWORD_DEFAULT),
				);

				if ($this->connect_model->set_user($data)) {
					$data['msg']=' ';
					$head['title']='Connexion';
		    		$head['style']='style_login';
					$this->load->view('quizz/templates/header', $head);
					$this->load->view('quizz/index', $data);
					$this->load->view('quizz/templates/footer');
				}
		    }
		}

		public function forget()
		{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('mail', 'Email', 'required');
		    $this->form_validation->set_rules('password', 'Mot de passe', 'required');
		    $this->form_validation->set_rules('passconf', 'Confirmation', 'required');

		    if ($this->form_validation->run() === FALSE) {
		    	$data['msg']=' ';
		    	$head['title']='Mot de passe oublié';
		    	$head['style']='style_login';
		    	$this->load->view('quizz/templates/header', $head);
				$this->load->view('quizz/forget', $data);
				$this->load->view('quizz/templates/footer');
		    }
		    else
		    {
		    	$email = $this->input->post('mail');
		    	$password = $this->input->post('password');
		    	$passconf = $this->input->post('passconf');
		    	if ($password == $passconf) {
		    		$password = password_hash($password, PASSWORD_DEFAULT);
		    		$data=array(
		    			'password'=>$password
		    		);
		    		if ($this->connect_model->update_pass($email, $data)) {
		    			$data['msg']=' ';
		    			$head['title']='Connexion';
		    			$head['style']='style_login';
		    			$this->load->view('quizz/templates/header', $head);
						$this->load->view('quizz/index', $data);
						$this->load->view('quizz/templates/footer');
		    		}
		    		else
		    		{
		    			$data['msg']='Adresse mail incorrect ou inexistante.';
		    			$head['title']='Mot de passe oublié';
		    			$head['style']='style_login';
			    		$this->load->view('quizz/templates/header', $head);
						$this->load->view('quizz/forget', $data);
						$this->load->view('quizz/templates/footer');
		    		}
		    	}
		    	else
		    	{
		    		$data['msg']='Mot de passe différent. Veuillez réessayer.';
		    		$head['title']='Mot de passe oublié';
		    		$head['style']='style_login';
		    		$this->load->view('quizz/templates/header', $head);
					$this->load->view('quizz/forget', $data);
					$this->load->view('quizz/templates/footer');
		    	}
		    }
		}

		public function deconnexion()
		{
			$this->load->library('session');
			$this->session->sess_destroy();
			redirect('accueil/index');
		}
	}