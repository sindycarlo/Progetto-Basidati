function squadexists($nomeS){
		$ris=mysql_query("SELECT Squadra.nome FROM Squadra WHERE Squadra.nome='$nomeS'");
		if(!mysql_fetch_row($ris))
		{
		return 0;
		}
		else
		return $ris;
	}
