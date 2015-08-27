-- Lisää INSERT INTO lauseet tähän tiedostoon
insert into kayttaja (id, kayttaja, salasana, rooli )
values ('1', 'testi1', 'testi1', '' );

insert into kayttaja (id, kayttaja, salasana, rooli )
values ('2', 'ns', 'ns', '' );

insert into raaka_aine (id, raaka_aine)
values ('1', 'punajuuri');

insert into raaka_aine (id, raaka_aine)
values ('2', 'kaali');

insert into raaka_aine (id, raaka_aine)
values ('3', 'suola');

insert into resepti (id, reseptin_nimi, annokset, valmisteluaika, kypsymisaika, uunin_asteet, valmistusohje, laatija)
values ('1', 'Bouillabaisse', '6', '30 min.', '30 min.', '000', 'Aloita ranskalaisen kala-äyriäiskeiton valmistus kaatamalla isoon kattilaan oliiviöljy ja 
    puolet silputusta valkosipulista. Kuumenna ja anna aromeiden avautua. Kaada joukkoon 
    reilut 4 dl valkoviiniä. Kun seos kiehahtaa, lisää joukkoon hyvin pestyt sinisimpukat ja keitä, 
    kunnes simpukat avautuvat. Nosta simpukat reikäkauhalla kulhoon odottamaan. 
    Valmista seuraavaksi aromikas liemi, eli kuullota isossa kattilassa tilkassa oliiviöljyä 
    loput hienonnetusta valkosipulista ja sipulisilppu. Lisää joukkoon tomaattipyree, 
    piparjuuritahna ja sokeri. Lisää 3 dl valkoviiniä ja anna sen hieman kiehua kasaan. 
    Kaada joukkoon kalaliemi ja kala- tai hummerifondi sekä lisää paloitellut perunat. 
    Anna kiehua miedolla lämmöllä, kunnes perunat ovat puolikypsiä. 
    Lisää joukkoon pikkuporkkanat tai ohuita porkkanasuikaleita. Kaada kerma pieneen kattilaan 
    ja anna sen kiehua kasaan niin, että kermasta tulee paksua. Kaada kerma isoon kattilaan, 
    lisää voi ja mausta liemi. Lisää lohikuutiot ja anna niiden kypsyä. Lisää lopuksi keiton 
    joukkoon kuorelliset katkaravut sekä jokiravun pyrstöt ja anna niiden lämmetä. 
    Nosta keittokattila sivuun. Ruskista lopuksi kuhafileet paistinpannulla kullanruskeiksi ja rapeiksi. 
    Kokoa annos: nosta lientä lautasen pohjalle, lisää kasviksia, lohta, simpukoita, katkarapuja, 
    jokiravun pyrstöjä, ja lopuksi paistettu kuhafilee. Koristele bouillabaisse tuoreella tillillä.', 'testi1');

