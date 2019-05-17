CREATE TABLE "admin" (
	"username"	TEXT,
	"password"	TEXT
);

CREATE TABLE "secteurActivite" (
	"idSecteur"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"libelle"	TEXT
);

CREATE TABLE "departement" (
	"CP"	INTEGER PRIMARY KEY,
	"libelle"	TEXT
);

CREATE TABLE "typeMorceau" (
	"idMorceau"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"libelle"	TEXT
);

CREATE TABLE "animal" (
	"idAnimal"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"libelle"	TEXT
);

CREATE TABLE "viande" (
	"idViande"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"libelle"	TEXT,
	"idMorceau"	INTEGER,
	"idAnimal"	INTEGER,
	FOREIGN KEY("idMorceau") REFERENCES "typeMorceau"("idMorceau"),
	FOREIGN KEY("idAnimal") REFERENCES "animal"("idAnimal")
);

CREATE TABLE "fournisseur" (
	"idFournisseur"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"nomEntreprise"	TEXT,
	"rue"	TEXT,
	"ville"	TEXT,
	"tel"	INTEGER,
	"mail"	TEXT,
	"CP"	INTEGER,
	"idSecteur"	INTEGER,
	FOREIGN KEY("CP") REFERENCES "departement"("CP"),
	FOREIGN KEY("idSecteur") REFERENCES "secteurActivite"("idSecteur")
);

CREATE TABLE "commande" (
	"idCommande"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"montant"	REAL,
	"date"	TEXT,
	"idFournisseur"	INTEGER,
	FOREIGN KEY("idFournisseur") REFERENCES "fournisseur"("idFournisseur")
);
CREATE TABLE "appartenir" (
	"idCommande"	INTEGER,
	"idAnimal"	INTEGER,
	"quantité"	REAL,
	PRIMARY KEY ("idCommande","idAnimal"),
	FOREIGN KEY("idCommande") REFERENCES "commande"("idCommande"),
	FOREIGN KEY("idViande") REFERENCES "viande"("idViande")
);

