CREATE TABLE Utilisateur(
	id SERIAL UNIQUE PRIMARY KEY,
	login text,
	password text,
	mail text,
	nom text,
	prenom text
);
