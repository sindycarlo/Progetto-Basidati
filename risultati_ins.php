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
	$sessoA=trim($_POST['sesso']);
	$categoriaA=trim($_POST['categoria']);
	//recupero i campi di tipo stringa per Squadra
	 $nomeS=trim($_POST['nome']);
	 //recupero i campi di tipo stringa per Gara
	 $tipoG=trim($_POST['tipoG']);
	 //recupero i campi di tipo stringa per Medaglia
	 $tipoM=trim($_POST['tipoM']);
	 $stileM=trim($_POST['stile']);
	 //recupero gli altri campi del form
	 $etaA=($_POST['eta']);
	 $tempoST=($_POST['tempo']);

	 ////se non inserisco i dati in modo corretto
	 if($tempoST<20)
	 {
		 echo "IL TEMPO NON E' COMPATIBILE";
	 
	 }else
	 {
	 if($etaA>26)
	 {
		 echo "L'ETA DEVE ESSERE INFERIORE A 26 ANNI ALTRIMENTI L'ALTLETA RISULTA FUORI CATEGORIA";
	 }
	 else
	 {
	 if(!ctype_digit($_POST['eta']))
	 {
	 	die("L'ETA' CHE INSERISCI DEVE ESSERE UN NUMERO");
	 }

	 if(ctype_digit($_POST['cognome']) || ctype_digit($_POST['nome']))
	 {
	 	die("IL NOME E IL COGNOME CHE INSERISCI NON POSSONO ESSERE NUMERI");
	 }
	 
	
	//preparo le query:
	$query1= "INSERT INTO Atleta (nome,cognome,eta,sesso,categoria)
				VALUES('$nomeA','$cognomeA','$etaA','$sessoA','$categoriaA')";


	function squadexists($nomeS){
		$ris=mysql_query("SELECT Squadra.nome FROM Squadra WHERE Squadra.nome='$nomeS'");
		if(!mysql_fetch_row($ris))
		{
			return 0;
		}
		else
		return $ris;
	}
	if(squadexists($nomeS)!=0){
		$query2="UPDATE Squadra SET Squadra.numeroatleti=Squadra.numeroatleti+1
				 WHERE Squadra.nome='$nomeS'";
	}else{
	$numatletiS=1;	
	$query2= "INSERT INTO Squadra (numeroatleti,nome)
				VALUES('$numatletiS','$nomeS')";
	}


	

	$query3="INSERT INTO Stile (tipo,tempo)
				VALUES('$stileM','$tempoST')";
	
	
				
	$query4="INSERT INTO Gara (tipo)
				VALUES('$tipoG')";



				
	$query5="INSERT INTO Medaglia (tipo,stile)
				VALUES('$tipoM','$stileM')";


	

		
	//lancio la query
	$result1=mysql_query($query1);
	$result2=mysql_query($query2);
	$result3=mysql_query($query3);
	$result4=mysql_query($query4);
	$result5=mysql_query($query5);
	
	//controllo l'esito
	if(!$result1){
		die(mysql_error());
	}
	if(!$result2){
		die("errore nella query $query2:" . mysql_error());
	}
	
	if(!$result3){
		die("errore nella query $query3".mysql_error());
	}
	if(!$result4){
		die("errore nella query $query4:" . mysql_error());
	}
	if(!$result5){
		die("errore nella query $query5:" . mysql_error());
	}
	


	////AGGIORNO LE RELAZIONI TRA LE TABELLE:
	$ris2=mysql_query("INSERT INTO Composta(atleta,squadra) VALUES ((SELECT Atleta.codiceatleta FROM Atleta order by codiceatleta DESC limit 1),(SELECT Squadra.codice FROM Squadra WHERE Squadra.nome='$nomeS'))") or die("errore nella query". mysql_error());
	$procedure2=mysql_query("CALL insertEseguono()") or die("query fail: " . mysql_error());
	$procedure3=mysql_query("CALL insertSvolge()") or die("query fail: " .mysql_error());
	$procedure4=mysql_query("CALL insertOttenute()") or die("query fail: " .mysql_error());	
	

	
	// recupero l'id autoincrement generato da MySQL per il nuovorecord inserito
		$id_inserito = mysql_insert_id();
		
		if($result1 && $result2 && $result3 && $result4 && $result5)
		{
			echo "INSERIMENTO DI UN ATLETA EFFETTUATO CON SUCCESSO";
			echo "<p>
	    			<a href='index.html' value='redirect'>torna alla Homepage</a>
	 			</p>";
		}		
	}
   }
		//$messaggio = urlencode('Inserimento effettuato con successo (ID=$id_inserito)');
	//header('location: '.$_SERVER['PHP_SELF'].'?msg='.$messaggio);

	// chiudo la connessione a MySQL
		mysql_close($link);
 
 }
 ?>
