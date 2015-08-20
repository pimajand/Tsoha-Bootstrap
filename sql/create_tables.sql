CREATE TABLE kayttaja (
id serial PRIMARY KEY ,
kayttaja varchar(6) NOT NULL ,
salasana varchar(8) NOT NULL ,
rooli varchar(20) NOT NULL 
);

CREATE TABLE resepti (
id serial PRIMARY KEY ,
reseptin_nimi varchar(50) NOT NULL ,
annokset varchar(3),
valmisteluaika varchar(15),
kypsymisaika varchar(15),
uunin_asteet varchar(7),
valmistusohje varchar(1500),
laatija varchar(6)
);

CREATE TABLE raaka_aine (
id serial PRIMARY KEY ,
raaka_aine varchar(30) NOT NULL 
);

CREATE TABLE reseptin_aine (
raaka_aine_id integer NOT NULL ,
resepti_id integer NOT NULL ,
PRIMARY KEY (raaka_aine_id, resepti_id),
FOREIGN KEY (resepti_id) REFERENCES resepti(id),
FOREIGN KEY (raaka_aine_id) REFERENCES raaka_aine(id)
);
