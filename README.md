# Intitulé : Réalisation d'une application Web afin de gérer les commandes ainsi que les fournisseurs pour l'entreprise Caquineau.


**Pour créer une viande, il faudra :**

    -La lier à un morceau.
  
    -La lier à un animal.
  
**Pour créer un fournisseur, il faudra :**

    -Le lier à un département.
  
    -le lier à un secteur d'activité.
  
    -Indiquer son nom d'entreprise, sa rue, sa ville, son tel ainsi que son email.
  
  
**Pour créer une commande, il faudra :**

    -Ajouter une viande ainsi que la quantité de chacune d'entre elles.
  
    -La lier à un fournisseur.
  
    -Indiquer le montant total et la date.
  
  
  
  REQUETES EFFECTUEES :
  
  CREATE TABLE "ville" (
	"idVille"	INTEGER PRIMARY KEY AUTOINCREMENT,
	"libelle"	TEXT,
	"idDepartement"	INTEGER,
	FOREIGN KEY("idDepartement") REFERENCES "departement"("CP")
);

ALTER TABLE fournisseur
ADD  idVille INTEGER,
FOREIGN KEY("idVille") REFERENCES "ville"("idVille");

INSERT INTO ville (libelle)
SELECT ville FROM fournisseur;

UPDATE fournisseur
SET idVille = (SELECT idVille FROM ville WHERE libelle= (SELECT ville FROM fournisseur))
WHERE ville= (SELECT libelle FROM ville)
  
  

  
