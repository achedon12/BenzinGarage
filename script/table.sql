##################################TABLE##################################

CREATE TABLE sae_garage.article (
	codearticle varchar(3) NOT NULL,
	libellearticle varchar(50) NOT NULL,
	qte_min int4 NOT NULL,
	typearticle varchar(10) NOT NULL,
	prixunitactuelht numeric(7, 2) NOT NULL,
	qte_stock int4 NOT NULL,
	commander bool NULL DEFAULT false,
	CONSTRAINT article_pkey PRIMARY KEY (codearticle),
	CONSTRAINT verif_type_art CHECK (((typearticle)::bpchar = ANY (ARRAY['Pièce'::bpchar, 'Fourniture'::bpchar])))
);



CREATE TABLE sae_garage.client (
	codeclient varchar(4) NOT NULL,
	nom varchar(50) NOT NULL,
	prenom varchar(50) NOT NULL,
	adresse varchar(50) NOT NULL,
	codepostal varchar(5) NOT NULL,
	ville varchar(50) NOT NULL,
	tel varchar(10) NOT NULL,
	mail varchar(50) NULL,
	datecreation date NOT NULL,
	CONSTRAINT client_mail_key UNIQUE (mail),
	CONSTRAINT client_pkey PRIMARY KEY (codeclient)
);



CREATE TABLE sae_garage.marque (
	nummarque serial4 NOT NULL,
	marque varchar(50) NOT NULL,
	CONSTRAINT marque_pkey PRIMARY KEY (nummarque)
);




CREATE TABLE sae_garage.mode_reglement (
	nomoderegl serial4 NOT NULL,
	libellemoderegl varchar(50) NOT NULL,
	CONSTRAINT mode_reglement_pkey PRIMARY KEY (nomoderegl)
);




CREATE TABLE sae_garage."role" (
	id_role varchar(50) NOT NULL,
	libelle_role varchar(50) NULL,
	id_personne varchar(50) NOT NULL,
	CONSTRAINT role_pkey PRIMARY KEY (id_role)
);




CREATE TABLE sae_garage.tarif_mo (
	codetarif varchar(2) NOT NULL,
	couthoraireactuelht numeric(5, 2) NOT NULL,
	CONSTRAINT tarif_mo_pkey PRIMARY KEY (codetarif)
);




CREATE TABLE sae_garage."user" (
	id varchar(5) NOT NULL,
	nom varchar(30) NOT NULL,
	prenom varchar(30) NOT NULL,
	"password" varchar(200) NOT NULL,
	"role" varchar(50) NOT NULL,
	CONSTRAINT operateur_pkey PRIMARY KEY (id),
	CONSTRAINT user_role_check CHECK ((((role)::text = 'employe'::text) OR ((role)::text = 'administrateur'::text) OR ((role)::text = 'manager'::text)))
);




CREATE TABLE sae_garage.modele (
	nummodele serial4 NOT NULL,
	modele varchar(50) NOT NULL,
	nummarque int4 NOT NULL,
	CONSTRAINT modele_pkey PRIMARY KEY (nummodele),
	CONSTRAINT modele_nummarque_fkey FOREIGN KEY (nummarque) REFERENCES sae_garage.marque(nummarque)
);




CREATE TABLE sae_garage.operation (
	codeop varchar(20) NOT NULL,
	libelleop varchar(50) NOT NULL,
	dureeop numeric(4, 2) NOT NULL,
	codetarif varchar(2) NOT NULL,
	CONSTRAINT operation_pkey PRIMARY KEY (codeop),
	CONSTRAINT operation_codetarif_fkey FOREIGN KEY (codetarif) REFERENCES sae_garage.tarif_mo(codetarif)
);




CREATE TABLE sae_garage.vehicule (
	noimmatriculation varchar(20) NOT NULL,
	noserie varchar(50) NULL,
	datemiseencirculation date NULL,
	nummodele int4 NOT NULL,
	codeclient varchar(10) NOT NULL,
	CONSTRAINT vehicule_pkey PRIMARY KEY (noimmatriculation),
	CONSTRAINT vehicule_codeclient_fkey FOREIGN KEY (codeclient) REFERENCES sae_garage.client(codeclient),
	CONSTRAINT vehicule_nummodele_fkey FOREIGN KEY (nummodele) REFERENCES sae_garage.modele(nummodele)
);




CREATE TABLE sae_garage.dde_interv (
	numdde serial4 NOT NULL,
	daterdv date NOT NULL,
	heurerdv time NOT NULL,
	descriptif_demande varchar(250) NULL,
	km_actuel int4 NULL,
	devis_on bool NOT NULL DEFAULT false,
	idoperateur varchar(5) NULL,
	noimmatriculation varchar(20) NULL,
	codeclient varchar(20) NULL,
	etatdemande varchar(50) NULL,
	CONSTRAINT dde_interv_pkey PRIMARY KEY (numdde),
	CONSTRAINT etatdemande CHECK (((etatdemande)::text = ANY ((ARRAY['Planifiee'::character varying, 'Annulee'::character varying, 'Definie'::character varying, 'Refusee'::character varying, 'Acceptee'::character varying, 'Facturee'::character varying])::text[]))),
	CONSTRAINT dde_interv_codeclient_fkey FOREIGN KEY (codeclient) REFERENCES sae_garage.client(codeclient),
	CONSTRAINT dde_interv_idoperateur_fkey FOREIGN KEY (idoperateur) REFERENCES sae_garage."user"(id),
	CONSTRAINT dde_interv_noimmatriculation_fkey FOREIGN KEY (noimmatriculation) REFERENCES sae_garage.vehicule(noimmatriculation)
);



CREATE TABLE sae_garage.facture (
	nofacture serial4 NOT NULL,
	datefacture date NOT NULL,
	tauxtva numeric(5, 2) NOT NULL,
	netapayer numeric(8, 2) NULL DEFAULT 0,
	etatfacture varchar(10) NULL,
	numdde int4 NOT NULL,
	CONSTRAINT facture_pkey PRIMARY KEY (nofacture),
	CONSTRAINT verif_etat_fact CHECK (((etatfacture)::bpchar = ANY (ARRAY['Emise'::bpchar, 'Réglée'::bpchar]))),
	CONSTRAINT foreign_key FOREIGN KEY (numdde) REFERENCES sae_garage.dde_interv(numdde)
);




CREATE TABLE sae_garage.prevoir_art (
	numdde int4 NOT NULL,
	codearticle varchar(20) NOT NULL,
	qte_prevue numeric(5, 2) NOT NULL,
	puht numeric(8, 2) NOT NULL,
	CONSTRAINT prevoir_art_pkey PRIMARY KEY (numdde, codearticle),
	CONSTRAINT prevoir_art_codearticle_fkey FOREIGN KEY (codearticle) REFERENCES sae_garage.article(codearticle),
	CONSTRAINT prevoir_art_numdde_fkey FOREIGN KEY (numdde) REFERENCES sae_garage.dde_interv(numdde)
);




CREATE TABLE sae_garage.prevoir_ope (
	numdde int4 NOT NULL,
	codeop varchar(20) NOT NULL,
	couthoraireht numeric(5, 2) NULL,
	duree_prevue numeric(4, 2) NULL,
	CONSTRAINT prevoir_ope_pkey PRIMARY KEY (numdde, codeop),
	CONSTRAINT prevoir_ope_codeop_fkey FOREIGN KEY (codeop) REFERENCES sae_garage.operation(codeop),
	CONSTRAINT prevoir_ope_numdde_fkey FOREIGN KEY (numdde) REFERENCES sae_garage.dde_interv(numdde)
);



CREATE TABLE sae_garage.realiser_op (
	codeop varchar(20) NOT NULL,
	nofacture int4 NOT NULL,
	couthoraireht numeric(5, 2) NOT NULL,
	duree_reelle numeric(4, 2) NOT NULL,
	CONSTRAINT realiser_op_pkey PRIMARY KEY (codeop, nofacture),
	CONSTRAINT realiser_op_codeop_fkey FOREIGN KEY (codeop) REFERENCES sae_garage.operation(codeop),
	CONSTRAINT realiser_op_nofacture_fkey FOREIGN KEY (nofacture) REFERENCES sae_garage.facture(nofacture)
);




CREATE TABLE sae_garage.reglement (
	noreglement serial4 NOT NULL,
	datereglement date NOT NULL,
	montantreglement numeric(8, 2) NOT NULL,
	nomoderegl int4 NOT NULL,
	nofacture int4 NOT NULL,
	CONSTRAINT reglement_nofacture_key UNIQUE (nofacture),
	CONSTRAINT reglement_pkey PRIMARY KEY (noreglement),
	CONSTRAINT reglement_nofacture_fkey FOREIGN KEY (nofacture) REFERENCES sae_garage.facture(nofacture),
	CONSTRAINT reglement_nomoderegl_fkey FOREIGN KEY (nomoderegl) REFERENCES sae_garage.mode_reglement(nomoderegl)
);




CREATE TABLE sae_garage.utiliser_art (
	codearticle varchar(20) NOT NULL,
	nofacture int4 NOT NULL,
	qte_fact numeric(5, 2) NOT NULL,
	puht numeric(8, 2) NOT NULL,
	CONSTRAINT utiliser_art_pkey PRIMARY KEY (codearticle, nofacture),
	CONSTRAINT utiliser_art_codearticle_fkey FOREIGN KEY (codearticle) REFERENCES sae_garage.article(codearticle),
	CONSTRAINT utiliser_art_nofacture_fkey FOREIGN KEY (nofacture) REFERENCES sae_garage.facture(nofacture)
);


##################################FONCTION##################################


CREATE OR REPLACE FUNCTION sae_garage.check_enough_qte()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
	begin 
		if new.qte_stock >= new.qte_min
			then new.commander = false ;
		end if;
		return new;
	end;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.check_low_qte()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
	begin 
		if new.qte_stock < new.qte_min
			then new.commander = true ;
		end if;
		return new;
	end;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.check_neg_price()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    begin
        if new.prixunitactuelht < 0
            then raise exception 'Le prix ne peut pas etre négatif';
        end if;
        return new;
    end;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.check_neg_stock()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
    begin
        if new.qte_stock < 0
            then raise exception 'Le stock ne peut pas etre négatif';
        end if;
        return new;
    end;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.complete_cout_prevoir_ope()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
begin
	update sae_garage.prevoir_ope 
	set couthoraireht = (select t.couthoraireactuelht*o.dureeop from sae_garage.tarif_mo t join sae_garage.operation o using(codetarif) where t.codetarif = o.codetarif and o.codeop = new.codeop)
	WHERE numdde = NEW.numdde AND duree_prevue IS NULL;
 RETURN NEW;

END;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.complete_duree_prevoir_ope()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
begin
	
  UPDATE sae_garage.prevoir_ope
  SET duree_prevue = (SELECT dureeop FROM sae_garage.operation WHERE codeop = NEW.codeop) WHERE numdde = NEW.numdde AND duree_prevue IS NULL;
  
  RETURN NEW;
END;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.create_facture_from_dde_interv()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
declare 
begin	
  INSERT INTO sae_garage.facture (numdde, datefacture, netapayer ,etatfacture, tauxtva) 
  VALUES (NEW.numdde, new.daterdv, (select sum(couthoraireht)+sum(couthoraireht)*0.2 from sae_garage.prevoir_ope po where numdde = new.numdde),'Emise', 20);
  RETURN NEW;
END;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.delete_client()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
BEGin  
	 
  UPDATE sae_garage.dde_interv
  SET codeclient = '1', noimmatriculation = '00-000-00'
  WHERE codeclient = OLD.codeclient;
  
  DELETE FROM sae_garage.vehicule WHERE codeclient = OLD.codeclient;
 
  RETURN OLD;
END;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.mis_a_jour_prix_facture()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
begin 
	update sae_garage.facture set 
    netapayer = (select sum(couthoraireht)+sum(couthoraireht)*0.2 from sae_garage.prevoir_ope where numdde = new.numdde) where numdde = new.numdde;
	RETURN NEW;
end;
$function$
;



CREATE OR REPLACE FUNCTION sae_garage.split_descriptif_demande()
 RETURNS trigger
 LANGUAGE plpgsql
AS $function$
BEGIN
  WITH split_descriptif_demande AS (
    SELECT string_to_array(NEW.descriptif_demande, ',') AS elements
  )
  INSERT INTO sae_garage.prevoir_ope (numdde, codeop)
  SELECT NEW.numdde, element
  FROM split_descriptif_demande, unnest(elements) element;
  
  RETURN NEW;
END;
$function$
;


##################################TRIGGER##################################



create trigger check_neg_stock_trigger before
insert or update  on sae_garage.article for each row execute function sae_garage.check_neg_stock();


create trigger check_neg_price_trigger before
insert or update on sae_garage.article for each row execute function sae_garage.check_neg_price();


create trigger check_low_qte_trigger before
insert or update on sae_garage.article for each row execute function sae_garage.check_low_qte();


create trigger check_enough_qte_trigger before
insert or update on sae_garage.article for each row execute function sae_garage.check_enough_qte();


create trigger delete_client before
delete on sae_garage.client for each row execute function sae_garage.delete_client();


create trigger split_descriptif_demande after
insert on sae_garage.dde_interv for each row execute function sae_garage.split_descriptif_demande();


create trigger create_facture_from_dde_interv after
insert on  sae_garage.dde_interv for each row execute function sae_garage.create_facture_from_dde_interv();


create trigger complete_duree_prevoir_ope after
insert on sae_garage.prevoir_ope for each row execute function sae_garage.complete_duree_prevoir_ope();


create trigger complete_cout_prevoir_ope after
insert  on sae_garage.prevoir_ope for each row execute function sae_garage.complete_cout_prevoir_ope();


create trigger mis_a_jour_prix_facture after
update  on  sae_garage.prevoir_ope for each row execute function sae_garage.mis_a_jour_prix_facture();
