<?php

if($_POST){
	inserisci_record();
}
 function inserisci_record()
 {

   //richiamo il file di configurazione
   require 'config_db.php';

   //richiamo lo script responsabile della connessione al database
   require 'connect_db.php';

   //recupero i campi di tipo stringa per Atleta
   
	$codiceA=trim($_POST['codice']);
	$nomeA=trim($_POST['nomeAtleta']);
	$cognomeA=trim($_POST['cognome']);
	$squadra=trim($_POST['nome']);
	 ////se non inserisco i dati in modo corretto
	$var1=false;
	 	$nome=mysql_query("SELECT Atleta.nome FROM Atleta WHERE Atleta.nome='$nomeA'");
	 	$cognome=mysql_query("SELECT Atleta.cognome FROM Atleta WHERE Atleta.cognome='$cognomeA'");
	 	if(!mysql_fetch_array($nome) || !mysql_fetch_array($cognome))
		{
			$var1=false;
		}
		else
		{$var1=true;}
	if($var1==true)
	{
	 $var=false;
	 	$nome=mysql_query("SELECT Atleta.nome FROM Atleta WHERE Atleta.nome='{$nomeA}'");
	 	$cognome=mysql_query("SELECT Atleta.cognome FROM Atleta WHERE Atleta.cognome='{$cognomeA}'");
	 	if(!mysql_fetch_array($nome) || !mysql_fetch_array($cognome))
		{
			$var=false;
		}
		else{

			$var=true;
		}

	////lancio la query:
	if($var==true)
	{
	////elimino i dati atleta:
	$query0=mysql_query("SELECT Atleta.codiceatleta FROM Atleta WHERE Atleta.codiceatleta='$codiceA'");
	$query1="DELETE FROM Atleta WHERE Atleta.codiceatleta='$codiceA'";
	$result1=mysql_query($query1);

	//////elimino i dati relativi alla squadra:
	$numatletiS=mysql_query("SELECT Squadra.numeroatleti FROM Squadra WHERE Squadra.nome='$squadra'");
		if(mysql_fetch_array($numatletiS)==1)
		{
				$query9="DELETE FROM Squadra WHERE Squadra.nome='$squadra'";
				mysql_query($query9);
		}
		else

		{
			$query2="UPDATE Squadra SET Squadra.numeroatleti=Squadra.numeroatleti-1
				 WHERE Squadra.nome='$squadra'";
			mysql_query($query2);
		}
	

	/////elimino i dati su Medaglia:
	$query2=mysql_query("SELECT Ottenute.medaglia FROM Ottenute WHERE Ottenute.atleta='$query0'");
	$query3="DELETE FROM Medaglia WHERE Medaglia.id='$query2'";
	$result2=mysql_query($query3);
	if(!$result2){echo 2;}
	
	/////elimino i dati su Stile:
	$query4=mysql_query("SELECT Eseguono.stile FROM Eseguono WHERE Eseguono.atleta='$query0'");
	$query5="DELETE FROM Stile WHERE Stile.id='$query4'";
	$result3=mysql_query($query5);
	if(!$result3){echo 3;}
	
	/////elimino i dati su Svolge:
	$query6="DELETE FROM Svolge WHERE Svolge.atleta='$query0'";
	$result4=mysql_query($query6);
	if(!$result4){echo 4;}
	echo "L'ATLETA E' STATO RIMOSSO";

	}else
	echo "L'ATLETA E' GIA' STATO RIMOSSO";


}
else echo "L'ATLETA CHE VUOI CANCELLARE NON E' NEL DATABASE";
	

	// chiudo la connessione a MySQL
		mysql_close($link);
 
 }
 ?>
