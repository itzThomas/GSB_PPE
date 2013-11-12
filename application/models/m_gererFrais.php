<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_gererFrais extends CI_Model{
	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from FicheFrais 
		where FicheFrais.mois = '$mois' and FicheFrais.idVisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}

	
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
			$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
	
		}
		$req = "insert into FicheFrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat)
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
		$unIdFrais = $uneLigneIdFrais['idfrais'];
				$req = "insert into LigneFraisForfait(idVisiteur,mois,idFraisForfait,quantite)
				values('$idVisiteur','$mois','$unIdFrais',0)";
				PdoGsb::$monPdo->exec($req);
		}
		}
	
		public function majFraisForfait($idVisiteur, $mois, $lesFrais){
			$lesCles = array_keys($lesFrais);
			foreach($lesCles as $unIdFrais){
				$qte = $lesFrais[$unIdFrais];
				$req = "update LigneFraisForfait set LigneFraisForfait.quantite = $qte
				where LigneFraisForfait.idVisiteur = '$idVisiteur' and LigneFraisForfait.mois = '$mois'
				and LigneFraisForfait.idFraisForfait = '$unIdFrais'";
				PdoGsb::$monPdo->exec($req);
			}
		
		}
	
		
		
		function valideInfosFrais($dateFrais,$libelle,$montant){
			if($dateFrais==""){
				ajouterErreur("Le champ date ne doit pas être vide");
			}
			else{
				if(!estDatevalide($dateFrais)){
					ajouterErreur("Date invalide");
				}
				else{
					if(estDateDepassee($dateFrais)){
						ajouterErreur("date d'enregistrement du frais dépassé, plus de 1 an");
					}
				}
			}
			if($libelle == ""){
				ajouterErreur("Le champ description ne peut pas être vide");
			}
			if($montant == ""){
				ajouterErreur("Le champ montant ne peut pas être vide");
			}
			else
			if( !is_numeric($montant) ){
				ajouterErreur("Le champ montant doit être numérique");
			}
		}
		/**
		 * Ajoute le libellé d'une erreur au tableau des erreurs
		 * 
		 */
		
	
		public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
			$dateFr = dateFrancaisVersAnglais($date);
			$req = "insert into LigneFraisHorsForfait
			values('','$idVisiteur','$mois','$libelle','$dateFr','$montant')";
			PdoGsb::$monPdo->exec($req);
		}
		
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
 
 
  ?>