<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_connexion extends CI_Controller {
	
    public function index()
    
    { 
    	
    	$data['titre'] = 'Connexion Site';
    	$data['access'] = $this->config->item('dossier_access');
    	
    	
    	//chargement du modele et de la page de connxion 	
    	$this->load->model('m_connexion'); 
    	$this->load->view('v_header',$data);
  		$this->load->view('v_connexion');
    	
    }

    public function connexion(){
    	$this->load->library('session');
    	$data['titre'] = 'Sommaire';
    	$data['access'] = $this->config->item('dossier_access');
    	 
    	
    
    	// Chargement de la bibliothèque
    	$this->load->model('m_connexion');
    	$this->load->library('form_validation');
    	 
    	// Règle des champs
    	$this->form_validation->set_rules('login','"login"','required | min_length[5]');
    	$this->form_validation->set_rules('mdp','"mdp"','required | min_length[5]');
   
    	// verification 
    	if ($this->form_validation->run() == TRUE)
    	{	 		
    		$login = mysql_real_escape_string($this->input->post('login'));
    		$mdp = mysql_real_escape_string($this->input->post('mdp'));
    		
    		$resultat = $this->m_connexion->connexion($login,$mdp);
    		
    		if ($resultat == 1){
    			
    			$info = $this->m_connexion->recupInfo($login);
    			$nom = $info;
    			
    			$nom = $info[0]['nom'];
    			$this->session->set_userdata('nom',$nom);
 				$data['nom'] = $nom;
 			
    			$this->load->view('v_header',$data);
    			$this->load->view('v_sommaire',$data);
    		
    			
    			//die("vrai");
    			
    	
    			
    		}
    		else{
    			
    			$this->load->model('m_connexion');
    					$this->load->view('v_header',$data);
    			$this->load->view('v_erreurs',$data);
    			//die("faux");
    		}
    		
    	}
    	else{
    		
    		$this->load->view('v_header',$config);
    		$this->load->view('v_erreurs');
    		//die("erreur");
    	}
}


public function deconnexion() {
	$this->session->sess_destroy();
	$this->index();
}
}
?>