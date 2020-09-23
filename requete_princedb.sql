create table t_fournisseur(id int primary key auto_increment, nom varchar(20) not null, postnom varchar(20));

create table t_categorie_produit(id int primary key auto_increment, nom varchar(20) not null, active char(1));

create table t_produit(id int primary key auto_increment, nom varchar(20) not null, active char(1), id_categorie_produit int,
	constraint fk_categorie_produit foreign key (id_categorie_produit) references t_categorie_produit(id)
	);

create table r_fournisseur_produit(id int primary key auto_increment, id_fournisseur int, id_produit int,
	constraint fk_fournisseur_produit foreign key(id_fournisseur) references t_fournisseur(id),
	constraint fk_produit_fournisseur foreign key (id_produit) references t_produit(id)
);

create table t_operation_fournisseur(id int primary key auto_increment, id_fournisseur int, id_produit int, quantite_produit int, montant float, date_fournissement date,
	constraint fk_operation_fournisseur foreign key (id_fournisseur) references t_fournisseur(id),
	constraint fk_operation_produit foreign key (id_produit) references t_produit(id)
);

create table t_type_unites(id int primary key auto_increment, id_produit int, nom_type varchar(20),
	constraint fk_type_unites foreign key (id_produit) references t_produit(id)
);

create table t_format_carte(id int primary key auto_increment, nom_format varchar(15), id_type_unites int,
	constraint fk_type_format foreign key (id_type_unites) references t_type_unites(id)
);

create table devise(id int primary key auto_increment, nom_devise varchar(10), active char(1) not null default "1");

ALTER TABLE t_operation_devise 
add CONSTRAINT fk_operation_devise FOREIGN KEY(id_devise) REFERENCES devise(id);

ALTER TABLE t_operation_fournisseur 
add CONSTRAINT fk_type_unites_operation FOREIGN KEY(id_type_unites) REFERENCES t_type_unites(id);

ALTER TABLE t_operation_fournisseur 
add CONSTRAINT fk_format_carte_operation FOREIGN KEY(id_format_carte) REFERENCES t_format_carte(id);



select p.nom, p.id from t_produit p, t_fournisseur f, r_fournisseur_produit pf
where pf.id_fournisseur = f.id
	and pf.id_produit = p.id
    and f.id = 1;
