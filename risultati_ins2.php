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
   
	$nomeA=trim($_POST['nomeAtleta']);
	$cognomeA=trim($_POST['cognome']);
	 //recupero i campi di tipo stringa per Gara
	 $tipoG=trim($_POST['tipoG']);
	 //recupero i campi di tipo stringa per Medaglia
	 $tipoM=trim($_POST['tipoM']);
	 $stileM=trim($_POST['stile']);
	 //recupero gli altri campi del form
	 $tempoST=($_POST['tempo']);

	 ////se non inserisco i dati in modo corretto
	
	if($tempoST!=NULL)
	{ $var=false;
	 	$nome=mysql_query("SELECT Atleta.nome FROM Atleta WHERE Atleta.nome='$nomeA'");
	 	$cognome=mysql_query("SELECT Atleta.cognome FROM Atleta WHERE Atleta.cognome='$cognomeA'");
	 	if(!mysql_fetch_array($nome) || !mysql_fetch_array($cognome))
		{
			$var=true;
			
		}
		else
			{
		 $var=false;}

	 if($var==false)
	 {
		 if(ctype_digit($_POST['cognome']) || ctype_digit($_POST['nomeAtleta']))
		 {
	 		die("IL NOME E IL COGNOME CHE INSERISCI NON POSSONO ESSERE NUMERI");
		 }
	

		$query3="INSERT INTO Stile (tipo,tempo)
				VALUES('$stileM','$tempoST')";
	
	
					
		$query4="INSERT INTO Gara (tipo)
				VALUES('$tipoG')";



				
		$query5="INSERT INTO Medaglia (tipo,stile)
				VALUES('$tipoM','$stileM')";




		//lancio la query
		$result3=mysql_query($query3);
		$result4=mysql_query($query4);
		$result5=mysql_query($query5);
		//richiamo le procedure per aggiornare le relazioni
		$procedure2=mysql_query("CALL insertEseguono1('$nomeA','$cognomeA')") or die("query fail1: " . mysql_error());
		$procedure3=mysql_query("CALL insertSvolge1('$nomeA','$cognomeA')") or die("query fail2: " .mysql_error());
		$procedure4=mysql_query("CALL insertOttenute1('$nomeA','$cognomeA')") or die("query fail3: " .mysql_error());	
		
		//controllo l'esito
		if(!$result3){
			die("errore nella query $query3:" . mysql_error());
		}
		if(!$result4){
		die("errore nella query $query4:" . mysql_error());
		}
		if(!$result5){
			die("errore nella query $query5:" . mysql_error());
		}

	
		// recupero l'id autoincrement generato da MySQL per il nuovorecord inserito
			$id_inserito = mysql_insert_id();

			
				echo "AGGIORNAMENTO ATLETA EFFETTUATO CON SUCCESSO";
					

			//$messaggio = urlencode('Inserimento effettuato con successo (ID=$id_inserito)');
		//header('location: '.$_SERVER['PHP_SELF'].'?msg='.$messaggio);

		// chiudo la connessione a MySQL
			mysql_close($link);


	} else echo "DEVI ANCORA INSERIRE L'ATLETA NEL DATABASE";
	}else echo "IL TEMPO NON E' COMPATIBILE";
 
 }
 ?>
