<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">

</head>
<h1>Les Contacts</h1>
<?php $this->load->helper('form');?>
<?php $this->load->helper('html');?>
<h2><?php echo $nbcontacts?> contacts : </h2>
<?php 
 foreach ($affiche as $item) {?>
 	<li><?php echo $item->Numero;?><span> - </span>
 	 <?php echo $item->Nom;?></li>
 	
 	<?php }?>
 	<br/>
 	<p><?php echo anchor('ajout_controleur', 'Ajouter un contact'); ?></p>
 	
	


</body>

</html>
<!-- <form method="post" action="intro-MVC-Contact.php" id="form1"> -->
<!-- <input  type ="text" name="nom" id="nom" value="Votre nom"/><br/> -->
<!-- <input  type ="text" name ="prenom" id ="prenom" value="Votre prenom"/><br/> -->
<!-- <input  type ="text" name="email" id="email" value="Votre email"/><br/> -->
<!-- <textarea rows="5" cols="20"> -->
<!-- Saisissez voter commentaire (text area 5 20) -->
<!-- </textarea> -->

<!-- <br/><input class="button" id="cmdSubAjout" type ="submit" name="cmdSubAjout" value="Envoyer"/> -->

<!-- </form>> -->