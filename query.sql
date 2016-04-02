
	1) Determinare gli atleti che hanno vinto solo medaglie d'oro', visualizzando il nome il cognome lo stile che hanno adottato, il tempo di gara e la medaglia. 
	
	
select Atleta.nome, Atleta.cognome, Stile.tipo as stile, Stile.tempo, Medaglia.tipo as medaglia  
from (((Atleta join Eseguono on Atleta.codiceatleta=Eseguono.atleta) join Stile on 	Eseguono.stile=Stile.id)  join Ottenute on Atleta.codiceatleta=Ottenute.atleta) join Medaglia 	on Ottenute.medaglia=Medaglia.id 
where Medaglia.tipo="oro" 
order by Stile.tempo;
	


	2)  Determinare la squadra che ha partecipato ad un maggior numero di campionati,visualizzando il numero di medaglie accumulate;

create view numpartecipazionisquadra as 
select Squadra.nome, count(anno) as numpartecipazioni 
from Squadra join Partecipazione on Squadra.codice=Partecipazione.squadra 
group by Squadra.codice;

select max(numpartecipazioni), nome, count(medaglia) as nummedaglie 
 from (numpartecipazionisquadra join Composta on codice=squadra)join Ottenute on Composta.atleta=Ottenute.atleta 
where nome="gymnasium"
 group by nome;





	3) Determinare tutte le atlete femmine, visualizzando le medaglie vinte, le gare e lo stile
 	    adottato.

select Atleta.nome, Svolge.gara as gara, Stile.tipo as stile, Stile.tempo as tempo, Ottenute.medaglia from (((Atleta join Svolge on Atleta.codiceatleta=Svolge.atleta) join Eseguono on Atleta.codiceatleta=Eseguono.atleta)join Stile on Eseguono.stile=Stile.id) join Ottenute on Atleta.codiceatleta=Ottenute.atleta join Medaglia on Medaglia.id=Ottenute.medaglia
where Atleta.sesso="F";



4)  Determinare gli atleti che hanno partecipato ad almeno due gare visualizzando il numero di gare, il nome e il cognome dell atleta.


select Atleta.nome, Atleta.cognome, count(distinct Svolge.gara) as numgare, Stile.tipo
 from ((Atleta join Svolge on Atleta.codiceatleta=Svolge.atleta)join Eseguono on Atleta.codiceatleta=Eseguono.atleta)join Stile on Eseguono.stile=Stile.id  
group by Atleta.codiceatleta 
having count(*)>1;




	5)Determinare gli atleti femmine e maschi che non hanno vinto alcuna medaglia,visualizzando il nome il cognome e lo stile di gara.

select Atleta.nome as nome, Atleta.cognome as cognome, Medaglia.stile as stile 
from (Atleta join Ottenute on Atleta.codiceatleta=Ottenute.atleta)join Medaglia on Ottenute.medaglia=Medaglia.id 
where Medaglia.tipo='NULL'






	6)Determinare il numero di atleti maschi e il numero di atlete femmine della squadra Gymnasium.

 create view AtletiSquadra as 
select Composta.atleta as atleti, Squadra.nome as squadra
 from Squadra join Composta on Squadra.codice=Composta.squadra 
where Squadra.nome='gymnasium'; 




select count(*) as numeroatletimaschi 
from Atleta join AtletiSquadra on Atleta.codiceatleta=AtletiSquadra.atleti
 where Atleta.sesso='M';    

select count(*) as numeroatletifemmine
from Atleta join AtletiSquadra on Atleta.codiceatleta=AtletiSquadra.atleti
 where Atleta.sesso='F'; 




