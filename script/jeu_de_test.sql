insert into client (codeclient, nom, prenom, adresse, codepostal, ville, tel, mail, datecreation)
values (2,'Michel', 'Mich', '12 rue des lilas', '26000', 'Valence', '0102030405', 'mail@Mich.com', current_date );

insert into vehicule (noimmatriculation, noserie, datemiseencirculation, nummodele , codeclient)
values ('AA-123-AA', '123', current_date, 19, 2);

insert into dde_interv (daterdv, heurerdv, descriptif_demande, km_actuel, idoperateur,noimmatriculation, codeclient, etatdemande)
values (current_date, current_time, 'ChangerPneu', 100, '3', 'AA-123-AA', 2, 'Planifiee' );




insert into client (codeclient, nom, prenom, adresse, codepostal, ville, tel, mail, datecreation)
values (3,'Robert', 'Rob', '13 rue des lilas', '26000', 'Valence', '0102030406', 'mail@Rob.com', current_date );

insert into vehicule (noimmatriculation, noserie, datemiseencirculation, nummodele , codeclient)
values ('BB-123-AA', '123', current_date, 21, 3);

insert into dde_interv (daterdv, heurerdv, descriptif_demande, km_actuel, idoperateur,noimmatriculation, codeclient, etatdemande)
values (current_date, current_time, 'Vidanger', 100, '3', 'BB-123-AA', 3, 'Planifiee' );

INSERT INTO sae_garage.reglement
(datereglement, montantreglement, nomoderegl, nofacture)
VALUES(current_date, 9, 1, 104);





INSERT INTO sae_garage."user"
(id, nom, prenom, "password", "role")
VALUES('1', 'noe', 'max', '123', 'administrateur');

INSERT INTO sae_garage."user"
(id, nom, prenom, "password", "role")
VALUES('2', 'gelly', 'val', '123', 'manager');

INSERT INTO sae_garage."user"
(id, nom, prenom, "password", "role")
VALUES('3', 'deroin', 'leo', '123', 'employe');






INSERT INTO sae_garage.marque
(marque)
VALUES('Peugeot');

INSERT INTO sae_garage.marque
(marque)
VALUES('Citroen');



INSERT INTO sae_garage.modele
(modele, nummarque)
VALUES('19', 1);

INSERT INTO sae_garage.modele
(modele, nummarque)
VALUES('21', 2);





INSERT INTO sae_garage.operation
(codeop, libelleop, dureeop, codetarif)
VALUES('ChangerPneu', 'ChPnAVG', 0.5, '1');

INSERT INTO sae_garage.operation
(codeop, libelleop, dureeop, codetarif)
VALUES('Vidanger', 'VidFiltHuil', 1.5, '2');

INSERT INTO sae_garage.tarif_mo
(codetarif, couthoraireactuelht)
VALUES('1', 10.50);

INSERT INTO sae_garage.tarif_mo
(codetarif, couthoraireactuelht)
VALUES('2', 5.00);





INSERT INTO sae_garage.article
(codearticle, libellearticle, qte_min, typearticle, prixunitactuelht, qte_stock, commander)
VALUES('5', 'Pneu', 8, 'Pièce', 99.99, 14, false);

INSERT INTO sae_garage.article
(codearticle, libellearticle, qte_min, typearticle, prixunitactuelht, qte_stock, commander)
VALUES('1', 'Huile', 5, 'Fourniture', 5.36, 3, true);



INSERT INTO sae_garage.mode_reglement
(libellemoderegl)
VALUES('CarteBleue');



