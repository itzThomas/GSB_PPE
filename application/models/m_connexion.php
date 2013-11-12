<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_connexion extends CI_Model{
	

	//verification login
	function connexion($login, $mdp){
	// connexion a la base et comparaison du login et du mot de passe 
		$this->load->database();
		
		//$reponse = ("SELECT count( * ) FROM visiteur where login='".$login."' and mdp='".$mdp."'");
		
		
		$this->db->count_all_results('visiteur');
		$this->db->from('visiteur');
		$this->db->where('login',$login);
	    $this->db->where('mdp',$mdp);
		return $this->db->count_all_results();
	
		
		
	}
	
	
	
	//Récupération des informations de l'user à partir de son login
	function recupInfo($login){
		$reponse = ("SELECT * FROM visiteur WHERE login = '".$login."'");
		$query = $this->db->query($reponse);
		return $query->result_array();
		
	}
	
	

	
	
}
/*Fin du fichier contact_model.php*/