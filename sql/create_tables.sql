CREATE TABLE kayttaja (
id serial NOT NULL ,
kayttaja varchar(6) NOT NULL ,
salasana varchar(8) NOT NULL ,
rooli varchar(20) NOT NULL ,
PRIMARY KEY (id )
);

CREATE TABLE resepti (
id serial NOT NULL ,
reseptin_nimi varchar(50) NOT NULL ,
annokset numeric(2) NOT NULL ,
valmisteluaika varchar(15) NOT NULL ,
kypsymisaika varchar(15) NOT NULL ,
uunin_asteet numeric(3) NOT NULL ,
kuva bytea ,
valmistusohje varchar(1500) NOT NULL,
laatija varchar(8) NOT NULL,
PRIMARY KEY (id )
);

CREATE TABLE raaka_aine (
id serial NOT NULL ,
raaka_aine varchar(30) NOT NULL ,
PRIMARY KEY (id )
);

CREATE TABLE reseptin_aine (
raaka_aine_id integer NOT NULL ,
resepti_id integer NOT NULL ,
maara varchar(20) NOT NULL ,
PRIMARY KEY (raaka_aine_id, resepti_id),
FOREIGN KEY (resepti_id) REFERENCES resepti(id),
FOREIGN KEY (raaka_aine_id) REFERENCES raaka_aine(id)
);
