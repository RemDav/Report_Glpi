# Report_Glpi
Ce code est à utilisateur avec le plugin "Reports" sous GLPI.
Grâce à ce code vous pour effectuer n'importe quelle statistique via GLPI.
Il faudra modifier dans le fichier : Name_file.php certaine ligne.
La ligne 7 : Nom du fichier de traduction (Name_File_Translate.fr_FR.php)
Ligne 9 : Entre les crochets, il faut avoir le même nom que le fichier de traduction.
Ligne 15 à 17 : Il faudra changer les champs désirés pour le tableau.
Ligne 22 à 34 : Il faudra modifier la requête SQL.
Dans le ficher : Name_File_Translate.fr_FR.php, il faudra changer la ligne 2.
Il faudra changer le deuxième jeu de crochet pour insérer le même nomque le fichier de traduction se trouvant dans la première page. Puis ce qu'il se trouve après "=" sera le nom affiché à l'utilisateur.
Le code présenté, effectue des statiques d'utilisateur ayant créé des tickets sous GLPI.
Ces utilisateurs font partie d'une certaine OU se trouvant dans Active Directory.
