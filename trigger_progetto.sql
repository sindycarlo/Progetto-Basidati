delimiter |

create trigger LIMITAGE
before insert on Atleta
for each row
begin
	if(new.eta>26)
	then insert into Stile values (2,3);
   	
	end if;
end |
delimiter;



delimiter |

create trigger CORRECTTEMPO
after insert on Stile
for each row
    begin
	if(new.tempo<=20)
	then insert into Atleta values (3,4);	
	
	end if;
end |
delimiter;








	

