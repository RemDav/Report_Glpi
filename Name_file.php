<?php
  $USEDBREPLICATE=1;
	$DBCONNECTION_REQUIRED=0;
	//Définition des bibliothèques de GLPI
	define('GLPI_ROOT', '../../../..');
	include (GLPI_ROOT . "/inc/includes.php");
	require ("Name_File_Translate.fr_FR.php");
	//Création du plugins
	$report = new PluginReportsAutoReport($LANG['plugin_reports']['Name_File_Translate']);
	//Permet d'afficher et de verifier dans la table "glpi_tickets.date". Pour utiliser le résultat il suffit de mettre dans la requête $report->addSqlCriteriasRestriction('AND') ou $report->addSqlCriteriasRestriction('where') pour une conditon
	$date = new PluginReportsDateIntervalCriteria($report, "glpi_tickets.date");
	//Rajoute les critères de recherche est donc obligatoire.
	$report->displayCriteriasForm();
	//Création des colonne à afficher avec les données récupéré de la requête
	$report->setColumns(array(new PluginReportsColumn('Realname', __('Name')),
								new PluginReportsColumn('Firstname', __('Fistname')),
                                new PluginReportsColumn('Total_créés', __('Number Ticket Open'))));
	//Vérifie si une date est rentrée
	if ($report->criteriasValidated()) 
	{
        $report->setSubNameAuto();
        $sql = "SELECT
        FROM_UNIXTIME(UNIX_TIMESTAMP(glpi_tickets.date),'%Y-%m') AS Dates, COUNT(glpi_tickets.id) AS Total_créés, glpi_users.realname AS Realname, glpi_users.firstname AS Firstname
        FROM glpi_tickets
        LEFT JOIN glpi_tickets_users ON (glpi_tickets_users.tickets_id = glpi_tickets.id)
        LEFT JOIN glpi_users ON (glpi_users.id = glpi_tickets_users.users_id)
        WHERE NOT glpi_tickets.is_deleted AND (glpi_tickets_users.users_id IN (SELECT  `id`
          FROM `glpi_users`
          WHERE `user_dn` LIKE '%CN_AD%'
        )
        AND glpi_tickets_users.type=1)".$report->addSqlCriteriasRestriction('AND').//Récupère la date du date picker GLPI et rajoute "and" dans ma condition
        "
        GROUP BY glpi_tickets_users.users_id
        ORDER BY Total_créés DESC";
        $report->setSqlRequest($sql);
        $report->execute($sql);
  }
?>
