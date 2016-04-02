

set foreign_key_checks=0;


Drop table if exists Atleta;

CREATE TABLE Atleta(
	codiceatleta integer(10) PRIMARY KEY AUTO_INCREMENT ,
	nome varchar(14) NOT NULL, 
	cognome varchar(20) NOT NULL,
	eta integer NOT NULL,
	sesso varchar(4) NOT NULL,
	categoria varchar(20) NOT NULL,

	FOREIGN KEY (categoria) REFERENCES Categoria(codice)
)ENGINE=INNODB;

Drop table if exists Squadra;

CREATE TABLE Squadra(
	codice integer(10) PRIMARY KEY AUTO_INCREMENT,
	numeroatleti integer NOT NULL,
	nome varchar(20) NOT NULL
	
)ENGINE=INNODB;

Drop table if exists Composta;

CREATE TABLE Composta(
	atleta integer(10) PRIMARY KEY,
	squadra integer(10) NOT NULL,
	
	FOREIGN KEY (atleta) REFERENCES Atleta(codiceatleta)
	ON DELETE CASCADE,
	FOREIGN KEY (squadra) REFERENCES Squadra(codice)
	ON DELETE CASCADE
)ENGINE=INNODB;

Drop table if exists Svolge;

CREATE TABLE Svolge(
	atleta integer(10),
	gara integer(10),
	PRIMARY KEY(atleta,gara),
	FOREIGN KEY (atleta) REFERENCES Atleta(codiceatleta)
	ON DELETE CASCADE,
	FOREIGN KEY (gara) REFERENCES Gara(codice)
	ON DELETE CASCADE
)ENGINE=INNODB;

Drop table if exists Gara;

CREATE TABLE Gara(
	codice integer(10) PRIMARY KEY AUTO_INCREMENT,
	tipo   varchar(10) NOT NULL
)ENGINE=INNODB;

Drop table if exists Eseguono;

CREATE TABLE Eseguono(
	atleta integer(10),
	stile integer(10),

	PRIMARY KEY(atleta,stile),
	FOREIGN KEY (atleta) REFERENCES Atleta(codiceatleta)
	ON DELETE CASCADE,
	FOREIGN KEY (stile) REFERENCES Stile(id)
	ON DELETE CASCADE
)ENGINE=INNODB;

Drop table if exists Stile;

CREATE TABLE Stile(
	id integer(10) PRIMARY KEY AUTO_INCREMENT,
	tipo varchar(20) NOT NULL,
	tempo integer NOT NULL
	
)ENGINE=INNODB;

Drop table if exists Partecipazione;

CREATE TABLE Partecipazione(
	squadra integer(9),
	edizione varchar(10),
	anno year,
	
	PRIMARY KEY(squadra,edizione,anno),
	FOREIGN KEY (squadra) REFERENCES Squadra(codice)
	ON DELETE CASCADE,
	FOREIGN KEY (edizione,anno) REFERENCES Campionato(edizione,anno)
	ON DELETE CASCADE
)ENGINE=INNODB;

Drop table if exists Campionato;

CREATE TABLE Campionato(
	edizione varchar(10) NOT NULL,
	anno year NOT NULL,
	PRIMARY KEY(edizione,anno)
)ENGINE=INNODB;

drop table if exists Ottenute;

CREATE TABLE Ottenute(
	atleta integer(10),
	medaglia integer(10),
	PRIMARY KEY(atleta, medaglia),
	FOREIGN KEY (atleta) REFERENCES Atleta(codiceatleta)
	ON DELETE CASCADE,
	FOREIGN KEY (medaglia) REFERENCES Medaglia(id)
	ON DELETE CASCADE
)ENGINE=INNODB;

Drop table if exists Medaglia;

CREATE TABLE Medaglia(
	id integer(10) PRIMARY KEY AUTO_INCREMENT,
	tipo varchar(10),
	stile varchar(12) NOT NULL
)ENGINE=INNODB;

Drop table if exists Categoria;

CREATE TABLE Categoria(
	codice varchar(10) PRIMARY KEY,
	tipo varchar(20) NOT NULL
)ENGINE=INNODB;





Drop table if exists Utente;

CREATE TABLE Utente(
	username varchar(20) NOT NULL,
	password varchar(20) NOT NULL
)ENGINE=INNODB;


INSERT INTO Utente VALUES('atleta','atleta');


INSERT INTO Atleta VALUES
('0001','carlo','sindico','20','M','cat2'),
('0002','alessio','barbui','19','M','cat2'),
('0003','gianluca','polonio','19','M','cat2'),
('0004','filippo','delzotto','20','M','cat2'),
('0005','lorenzo','bortolin','17','M','cat3'),
('0006','bobo','cardullo','16','M','cat3'),
('0007','alberto','colombo','15','M','cat3'),
('0008','giuseppe','calderan','24','M','cat1'),
('0009','alice','romano','19','F','cat2'),
('0010','anna','brenelli','19','F','cat2'),
('0011','vittoria','prataviera','20','F','cat2'),
('0012','elisa','zambon','19','F','cat2'),
('0013','gianni','loris','19','M','cat2'),
('0014','luca','boscolo','21','M','cat2');

INSERT INTO Squadra VALUES
('003','5','gymnasium'),
('004','3','acquagym'),
('005','6','acquasplash');


INSERT INTO Composta VALUES
('0001','003'),
('0002','003'),
('0003','004'),
('0004','004'),
('0005','004'),
('0006','003'),
('0007','003'),
('0008','005'),
('0009','005'),
('0010','005'),
('0011','005'),
('0012','005'),
('0013','005'),
('0014','003');

INSERT INTO Gara VALUES
('1','maschile'),
('2','maschile'),
('3','maschile'),
('4','femminile'),
('5','maschile');


INSERT INTO Svolge VALUES
('0001','1'),
('0001','5'),
('0002','1'),
('0002','5'),
('0003','1'),
('0003','5'),
('0004','1'),
('0005','2'),
('0006','2'),
('0007','2'),
('0008','3'),
('0009','4'),
('0010','4'),
('0011','4'),
('0012','4'),
('0013','4'),
('0014','1');


INSERT INTO Stile VALUES
('01','dorso','30'),
('02','rana','41'),
('03','dorso','35'),
('04','delfino','44'),
('05','dorso','50'),
('06','rana','30'),
('07','delfino','45'),
('08','stile libero','28'),
('09','stile libero','33'),
('10','rana','38'),
('11','dorso','29'),
('12','delfino','32'),
('13','stile libero','40'),
('14','rana','35'),
('15','stile libero','60'),
('16','dorso','56');


INSERT INTO Eseguono VALUES
('0001','01'),
('0001','14'),
('0002','11'),
('0002','02'),
('0003','03'),
('0003','06'),
('0004','05'),
('0005','07'),
('0006','12'),
('0007','04'),
('0008','06'),
('0009','08'),
('0010','09'),
('0011','13'),
('0012','13'),
('0013','15'),
('0014','16');


INSERT INTO Campionato VALUES
('quinta','2015'),
('quarta','2014'),
('terza','2013'),
('seconda','2012'),
('prima','2011');

INSERT INTO Partecipazione VALUES
('003','quinta','2015'),
('004','quinta','2015'),
('005','quinta','2015'),
('003','quarta','2014'),
('004','quarta','2014'),
('005','quarta','2014'),
('003','terza','2013'),
('004','terza','2013'),
('005','seconda','2012'),
('003','seconda','2012'),
('003','prima','2011'),
('004','prima','2011'),
('005','prima','2011');



INSERT INTO Medaglia VALUES
('001','oro','dorso'),
('002','argento','rana'),
('003','bronzo','dorso'),
('004','oro','delfino'),
('005','argento','delfino'),
('006','bronzo','rana'),
('007','argento','dorso'),
('008','oro','rana'),
('009','oro','stile libero'),
('010','argento','stile libero'),
('011','bronzo','delfino'),
('012','bronzo','stile libero'),
('013','NULL','stile libero'),
('014','NULL','dorso');



INSERT INTO Ottenute VALUES
('0001','007'),
('0001','002'),
('0002','003'),
('0002','006'),
('0003','008'),
('0004','001'),
('0005','011'),
('0006','004'),
('0007','005'),
('0008','008'),
('0009','009'),
('0010','010'),
('0011','012'),
('0012','012'),
('0013','013'),
('0014','014');




INSERT INTO Categoria VALUES
('cat1','senior'),
('cat2','cadetti'),
('cat3','junior');





	
	
	

