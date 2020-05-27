CREATE TABLE Etudiant(
	id SERIAL UNIQUE PRIMARY KEY,
	user_id int,
	nom text,
	prenom text,
	note int
);

