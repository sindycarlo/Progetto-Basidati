<?php
   //richiamo il file di configurazione
   require 'config_db.php';

   //richiamo lo script responsabile della connessione al database
   require 'connect_db.php';

   //recupero i campi di tipo stringa per Atleta
	$nomeA=$_POST['nome'];
	$cognomeA=$_POST['cognome'];
	$sessoA=$_POST['sesso'];
	$categoriaA=$_POST['categoria'];
	 //recupero gli altri campi del form
	 $etaA=$_POST['eta'];

	 ////verifico se i dati inseriti sono corretti:
	 if(!ctype_digit($_POST['eta']))
	 {
	 	die("L'ETA' CHE INSERISCI DEVE ESSERE UN NUMERO");
	 }

	 if(ctype_digit($_POST['cognome']) || ctype_digit($_POST['nome']))
	 {
	 	die("IL NOME E IL COGNOME CHE INSERISCI NON POSSONO ESSERE NUMERI");
	 }
	//preparo la query
	
	$query="SELECT DISTINCT  Stile.tipo as STILI, Stile.tempo as TEMPI  FROM (((Atleta join Svolge on Atleta.codiceatleta=Svolge.atleta)join Eseguono on Atleta.codiceatleta=Eseguono.atleta) join Stile on Eseguono.stile=Stile.id)  WHERE Atleta.nome='$nomeA' AND Atleta.cognome='$cognomeA' AND Atleta.eta='$etaA' AND Atleta.sesso='$sessoA' AND Atleta.categoria='$categoriaA';
";
	$query1=" SELECT   Medaglia.tipo as MEDAGLIE  FROM Atleta join Ottenute on Atleta.codiceatleta=Ottenute.atleta join Medaglia on Medaglia.id=Ottenute.medaglia WHERE Atleta.nome='$nomeA' AND Atleta.cognome='$cognomeA' AND Atleta.eta='$etaA' AND Atleta.sesso='$sessoA' AND Atleta.categoria='$categoriaA';";
				
	//lancio la query
	$result=mysql_query($query);
	$result1=mysql_query($query1);
	//controllo l'esito
	if(mysql_num_rows($result)==0)
	{
		die("NON C'È ALCUN ATLETA CON QUESTE CARATTERISTICHE");
	}
	if(!$result){
		die("errore nella query:" . mysql_error());
	}
	
	echo '
	<table border="1">
		<tr>
			
			<th>STILI</th>
			<th>TEMPI</th>
		</tr>';

	while ($row = mysql_fetch_array($result)) {
		
		$stili     = htmlentities($row['STILI']);
		$tempi     = htmlentities($row['TEMPI']);
	


		echo "<tr>
				
				<td>$stili</td>
				<td>$tempi</td>
			</tr>";
}


	echo '</table>';
		
		
		
		echo '
	<table border="1">
		<tr>
			
			<th>MEDAGLIE</th>
			
		</tr>';

	while ($row1 = mysql_fetch_array($result1)) {
		
		$medaglie= htmlentities($row1['MEDAGLIE']);

	


		echo "<tr>
				
				<td>$medaglie</td>
				
			</tr>";
}


	echo '</table>';
	
	
	
	
	
	
	

	// libero la memoria di PHP occupata dai record estratti con la SELECT
	mysql_free_result($result);

	// chiudo la connessione a MySQL
	mysql_close();

 ?>


