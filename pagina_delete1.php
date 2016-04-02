
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
include("connect_db.php");
include("config_db.php"); // Include il file di connessione al database
$user=$_REQUEST["username"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
$paswd=$_REQUEST["password"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password
if($user!="" && $paswd!="")
{
$query = mysql_query("SELECT * FROM Utente WHERE username='".$user."' AND password ='".$paswd."'"); //per selezionare nel db l'utente e pw che abbiamo appena scritto nel log
// Con il SELECT qua sopra selezione dalla tabella users l utente registrato (se lo è) con i parametri che mi ha passato il form di login, quindi
// Quelli dentro la variabile POST. username e password.


$numrighe=mysql_num_rows($query);
if($numrighe!=0){        //se c'è una persona con quel nome nel db allora loggati
echo '
	
<form name="pagina_delete.html" action="risultati_delete1.php" method="post">
	  <legend>Inserisci i dati relativi all atleta:</legend>
	  <p>
	    <label>codice:
	    <input name="codice" type="text" />
	    </label>
	  </p>
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
	  <p>
	    <label>squadra:
	    <input name="nome" type="text" />
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
