<?php
$link=mysql_connect('basidati1004.studenti.math.unipd.it','csindico','mP5ebZsx');
if(!$link){
	die('non riesco a connettermi: ' .mysql_error());
 }
 
 $db_selected=mysql_select_db('csindico-PR',$link);
 if(!$db_selected){
	die('errore nella selezione del database: ' . mysql_error());
 }
 

 
 //mysql_close($link);
 ?>
