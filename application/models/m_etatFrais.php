
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_etatFrais extends CI_Model{
	// -> Fonction de Gerer frais
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select FicheFrais.mois as mois from  FicheFrais where FicheFrais.idVisiteur ='$idVisiteur'
		order by FicheFrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
					"mois"=>"$mois",
					"numAnnee"  => "$numAnnee",
					"numMois"  => "$numMois"
			);
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}


	// -> Fonction de Gerer frais 2e
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select FraisForfait.id as idfrais, FraisForfait.libelle as libelle,
		LigneFraisForfait.quantite as quantite from LigneFraisForfait inner join FraisForfait
		on FraisForfait.id = LigneFraisForfait.idFraisForfait
		where LigneFraisForfait.idVisiteur ='$idVisiteur' and LigneFraisForfait.mois='$mois'
		order by LigneFraisForfait.idFraisForfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	// -> Fonction de gerer frais 3e
	public function getLesFraisHorsForfait($idVisiteur,$mois){
		$req = "select * from LigneFraisHorsForfait where LigneFraisHorsForfait.idVisiteur ='$idVisiteur'
		and LigneFraisHorsForfait.mois = '$mois' ";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes;
	}

	// fonction de gerer frais 4e
	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select FicheFrais.idEtat as idEtat, FicheFrais.dateModif as dateModif, FicheFrais.nbJustificatifs as nbJustificatifs,
		FicheFrais.montantValide as montantValide, Etat.libelle as libEtat from  FicheFrais inner join Etat on FicheFrais.idEtat = Etat.id
		where FicheFrais.idVisiteur ='$idVisiteur' and FicheFrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}


	//fonction de gerer frais 5e

	function dateFrancaisVersAnglais($maDate){
		@list($jour,$mois,$annee) = explode('/',$maDate);
		return date('Y-m-d',mktime(0,0,0,$mois,$jour,$annee));
	}

}
