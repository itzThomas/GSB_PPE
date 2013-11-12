<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_etatFrais extends CI_Controller {

	public function index()

	{
			
		$data['titre'] = 'Etats ';
		$data['access'] = $this->config->item('dossier_access');
		//chargement du modele et de la page de connxion
		$this->load->model('m_etatFrais');
		$this->load->view('v_header',$data);
		$this->load->view('v_etatFrais');
			
	}

}


// include("vues/v_sommaire.php");
// $action = $_REQUEST['action'];
// $idVisiteur = $_SESSION['idVisiteur'];
// switch($action){
// 	case 'selectionnerMois':{
// 		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
// 		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
// 		// on demande toutes les clés, et on prend la première,
// 		// les mois étant triés décroissants
// 		$lesCles = array_keys( $lesMois );
// 		$moisASelectionner = $lesCles[0];
// 		include("vues/v_listeMois.php");
// 		break;
// 	}
// 	case 'voirEtatFrais':{
// 		$leMois = $_REQUEST['lstMois'];
// 		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
// 		$moisASelectionner = $leMois;
// 		include("vues/v_listeMois.php");
// 		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
// 		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
// 		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
// 		$numAnnee =substr( $leMois,0,4);
// 		$numMois =substr( $leMois,4,2);
// 		$libEtat = $lesInfosFicheFrais['libEtat'];
// 		$montantValide = $lesInfosFicheFrais['montantValide'];
// 		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
// 		$dateModif =  $lesInfosFicheFrais['dateModif'];
// 		$dateModif =  dateAnglaisVersFrancais($dateModif);
// 		include("vues/v_etatFrais.php");
// 	}
// }
?>