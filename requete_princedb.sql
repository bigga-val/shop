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


select of.date_fournissement, of.montant, of.quantite_produit, p.nom, d.nom_devise
from t_operation_fournisseur of, t_produit p, devise d
where of.id_produit = p.id
	and of.id_devise = d.id_devise
	order by of.date_fournissement DESC;

create table utilisateur(id int primary key auto_increment, login varchar(20), email varchar(50), password varchar(100));

create table t_agent(id int primary key auto_increment, nom varchar(20), postnom varchar(20), prenom varchar(20), 
	date_naissance date, adresse varchar(50), telephone varchar(15), date_embauche date
);
create table t_agent_produit(id int primary key auto_increment, id_produit int, id_agent int,
	constraint fk_agent_produit foreign key(id_produit) references t_produit(id),
	constraint fk_produit_agent foreign key(id_agent) references t_agent(id)
);


create table t_historique_fournissement_agent(id int primary key auto_increment, date_fournissement date, 
	id_agent_produit int ,montant double, quantite int, id_type_unites int, id_format_carte int,
	constraint fk_historique_agent_produit foreign key(id_agent_produit) references t_agent_produit(id),
	constraint fk_historique_type_unites foreign key(id_type_unites) references t_type_unites(id),
	constraint fk_historique_format_carte foreign key(id_format_carte) references t_format_carte(id)
);

create table stock_agent(id int primary key auto_increment, date_stock date, id_agent_produit int,
	montant_initial double, montant_operations double, montant_restant double,
	quantite_initiale double, quantite_operations double, quantite_restant double,
	id_historique_fournissement int,
	constraint fk_stock_agent_produit foreign key(id_agent_produit) references t_agent_produit(id),
	constraint fk_stock_historique_fournissement foreign key(id_historique_fournissement) references t_historique_fournissement_agent(id)
)


select st.date_stock, p.nom, st.montant_initial, st.montant_operations, st.montant_restant,
	st.quantite_initiale, st.quantite_operations, st.quantite_restant
from stock_agent st, t_produit p, t_agent a, t_agent_produit ap
where st.id_agent_produit = ap.id
	and a.id = ap.id_agent
	and p.id = ap.id_produit
	and a.id = 2;

select a.prenom, pc.id, pc.nom from t_categorie_produit pc, t_produit p, t_agent_produit ap, t_agent a
where pc.id = p.id_categorie_produit
	and p.id = ap.id_produit
	and a.id = ap.id_agent
	and a.id = 3
	GROUP BY pc.id;

