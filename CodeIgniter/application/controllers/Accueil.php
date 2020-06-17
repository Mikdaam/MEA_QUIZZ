<?php
	/**
	 * 
	 */
	class Accueil extends CI_Controller
	{
		public function index()
		{
			$head['style']='style_accueil';
			$head['title']='Accueil';
			$this->load->view('quizz/templates/header', $head);
			$this->load->view('quizz/accueil');
		}
	}