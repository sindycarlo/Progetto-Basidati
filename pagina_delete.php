

	
<?php
   //richiamo il file di configurazione
   require 'config_db.php';

   //richiamo lo script responsabile della connessione al database
   require 'connect_db.php';

	//preparo la query
	$query="SELECT Atleta.codiceatleta as CODICE, Atleta.nome as NOME, Atleta.cognome as COGNOME, Atleta.eta as ETA, Atleta.sesso as SESSO, 
	Atleta.categoria as CATEGORIA, Squadra.nome AS SQUADRA FROM Atleta join Composta on Atleta.codiceatleta=Composta.atleta join Squadra on Composta.squadra=Squadra.codice";
				
	//lancio la query
	$result=mysql_query($query);
	
	
	
	

	//controllo l'esito
	if(mysql_num_rows($result)==0)
	{
		die("NON C'È ALCUN ATLETA");
	}
	
	
	
	echo '
	<table border="1">
		<tr>
			
			<th>CODICE</th>
			<th>NOME</th>
			<th>COGNOME</th>
			<th>ETA</th>
			<th>SESSO</th>
			<th>CATEGORIA</th>
			<th>SQUADRA</th>
		</tr>';

	while ($row = mysql_fetch_array($result)) {
		
		$CODICE     = htmlentities($row['CODICE']);
		$NOMI     = htmlentities($row['NOME']);
		$COGNOMI     = htmlentities($row['COGNOME']);
		$ETA     = htmlentities($row['ETA']);
		$SESSI    = htmlentities($row['SESSO']);
		$CATEGORIE     = htmlentities($row['CATEGORIA']);
		$SQUADRE     = htmlentities($row['SQUADRA']);
	


		echo "<tr>
				
				<td>$CODICE</td>
				<td>$NOMI</td>
				<td>$COGNOMI</td>
				<td>$ETA</td>
				<td>$SESSI</td>
				<td>$CATEGORIE</td>
				<td>$SQUADRE</td>
			</tr>";
}

	echo '</table>';
		
		
	echo "(conservare il codice e la squadra dell'atleta per eliminarlo)";

	// libero la memoria di PHP occupata dai record estratti con la SELECT
	mysql_free_result($result);

	// chiudo la connessione a MySQL
	mysql_close();

 ?>


	
	

