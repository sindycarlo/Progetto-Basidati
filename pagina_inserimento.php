
<html>
	
<head>

<title>Storico delle Gare</title>
<style type="text/css">
body {
background-image: url('DSC0004.jpg')
}
form{width: 350px;border: 5px solid #7EA4D8;
    padding-bottom: 10px;background-color: #BBD8FF}
    
fieldset{border: 0px solid #000}

label {
    display: inline-block; 
    width: 10px; 
}

legend{font: bold 140%/1.6 Arial,sans-serif;color: #27518A}

form p{margin: 10px 10px 20px}

fieldset label{float:left;width:100px;
    line-height: 23px;margin-right: 5px;text-align: right} 
    
    fieldset input,textarea{ margin-bottom:5px;border-style: solid;
    border-color: #778AA2 #7EA4D8 #7EA4D8 #778AA2;
    border-width: 2px 1px 1px 2px} 
    
</style> 

<?php

//session_start();// come sempre prima cosa, aprire la sessione 
error_reporting (E_ERROR |      E_PARSE);
include("connect_db.php"); // Include il file di connessione al database
$user=$_REQUEST["username"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
$paswd=$_REQUEST["password"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password
if($user!="" && $paswd!="")
{
$query = mysql_query("SELECT * FROM Utente WHERE username='".$user."' AND password ='".$paswd."'"); //per selezionare nel db l'utente e pw che abbiamo appena scritto nel log
// Con il SELECT qua sopra selezione dalla tabella users l utente registrato (se lo è) con i parametri che mi ha passato il form di login, quindi
// Quelli dentro la variabile POST. username e password.


$numrighe=mysql_num_rows($query);
if($numrighe!=0){        //se c'è una persona con quel nome nel db allora loggati
echo '<form name="pagina_inserimento.html" action="risultati_ins.php" method="post">
	  <legend>Inserisci atleta:</legend>
	  <p>
	    <label>nome:
	    <input name="nomeAtleta" type="text" />
	    </label>
	  </p>
	  <p>
	    <label>cognome:
	    <input name="cognome" type="text" />
	    </label>
	  </p>
	   <p>
	    <label>eta:
	    <input name="eta" type="integer" />
	    </label>
	  </p>
	  <p><label> Sesso:
	  	  <select name="sesso">
	      <option value="M">maschio</option>
	      <option value="F">femmina</option>
	    </select>
	    </label>
	  
	  </p>
	  <p>
	    <label>categoria:
	    <select name="categoria" required>
	      <option value="cat3">junior</option>
	      <option value="cat2">cadetti</option>
	      <option value="cat1">senior</option>
	    </select>
	    </label>
	  </p>
	
	
	

<legend>inserisci squadra:</legend>
	  <p>
	    <label>nome:
	    <input name="nome" type="text" />
	    </label>
	  </p>
	
	
	
<legend>inserisci  tempo(secondi): </legend>
	   <p>
	    <label>tempo:
	    <input name="tempo" type="integer" />
	    </label>
	  </p>
	
<legend>inserisci  gara: </legend>
	
	  <p>
	    <label>tipo:
	    <select name="tipoG">
	      <option value="maschile">maschile</option>
	      <option value="femminile">femminile</option>
	    </select>
	    </label>
	  </p>
	
<legend>inserisci medaglia : </legend>
	  <p>
	    <label>tipo:
	    <select name="tipoM">
	      <option value="oro">oro</option>
	      <option value="argento">argento</option>
	      <option value="bronzo">bronzo</option>
	      <option value="NULL">nessuna</option>
	    </select>
	    </label>
	  </p>
	    <p>
	    <label>stile:
	    <select name="stile">
	      <option value="stile libero">stile libero</option>
	      <option value="dorso">dorso</option>
	      <option value="rana">rana</option>
	      <option value="delfino">delfino</option>
	    </select>
	    </label>
	  </p>
	  <p>
	    <input name="invia" type="submit" value="invia" />
	  </p>
</form>';
}else echo "NON HAI INSERITO I DATI DI LOGIN CORRETTAMENTE";
}else{
echo "NON HAI INSERITO I DATI DI LOGIN";  // altrimenti esce scritta a video questa stringa di errore
}


?>

</head>

<body>
	
</body>	
	
	
</html>
