<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

</head>
<?php $this->load->helper('form');?>
<?php $this->load->helper('html');?>

<h2>nouveau contact :</h2>


<?php echo validation_errors();
echo 	form_open('ajout_controleur/ajout_contact');
echo	form_input('Nom', 'Votre Nom');
echo br(1);
echo	form_input('prenom', 'Votre Prenom');
echo br(1);
echo	form_input('email', 'Votre Email');
echo br(1);
$textarea = Array ("name" =>'Commentaire', "rows" => "5" ,"cols"=> "20", "value"=>"Saisir votre commentaire");
echo 	form_textarea($textarea);
echo br(1);
echo 	form_submit('Envoyer', 'Envoyer');
echo 	form_close();

?>
<p><?php echo anchor('contact_controleur', 'Afficher la liste'); ?></p>