INSERT INTO `personne`(`role`, `adherent`, `login`, `password`) VALUES ("administrateur",1,"damien","marion");
INSERT INTO `personne`(`role`, `adherent`, `login`, `password`) VALUES ("ancien élève",1,"paul","ochon");
INSERT INTO `personne`(`role`, `adherent`, `login`, `password`) VALUES ("ancien élève",0,"ancien","élève");
INSERT INTO `personne`(`role`, `adherent`, `login`, `password`) VALUES ("élève",1,"florian","zeller");

INSERT INTO `offre`(`type`, `titre`, `entreprise`, `valide`, `secteur`, `lieu`, `remuneration`, `contact`, `fichier`, `offre_code`, `description`, `date_creation`, `date_validation`, `nom_contact`) VALUES ("stage","Promouvoir l'école","ENSC",1,"communication","Talence",0,"bclaverie@ensc.fr","ENSC.pdf","aq1zs2ed3rf4tg5","Par exemple, en venant aux portes ouvertes au lieu de se réveiller à 18 heures ...",1487424456,1489843656,"Bernard Claverie");
INSERT INTO `offre`(`type`, `titre`, `entreprise`, `valide`, `secteur`, `lieu`, `remuneration`, `contact`, `fichier`, `offre_code`, `description`, `date_creation`, `date_validation`, `nom_contact`) VALUES ("emploi","Enseignant-chercheur en procrastination","ENSC",0,"UX design","Talence",10001000,"bclaverie@ensc.fr","ENSC2.pdf","azer1qsdf2wxcv3","Je veux que mes étudiants soient au top de la procrastination",1552915656,1555590456,"Bernard Claverie");

INSERT INTO `postuler`(`offre_id`, `personne_id`) SELECT offre_id, personne_id FROM offre, personne WHERE titre="Enseignant-chercheur en procrastination" AND login = "florian";
INSERT INTO `sauvegarder`(`offre_id`, `personne_id`) SELECT offre_id, personne_id FROM offre, personne WHERE titre="Promouvoir l'école" AND login = "ancien";
INSERT INTO `est_dispo`(`offre_id`, `personne_id`) SELECT offre_id, personne_id FROM offre, personne WHERE titre="Enseignant-chercheur en procrastination" AND login = "paul";
