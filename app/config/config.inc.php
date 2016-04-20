<?php

/*
 * -------------------------------------
 * Constants de l'aplicació
 * Config.php
 * -------------------------------------
 */

//Configuració de rutes segons S.O.
define('DS', DIRECTORY_SEPARATOR); //separador segons S.O.
define('ROOT', realpath(dirname(__FILE__) . DS .".." . DS . ".." . DS) . DS); //Directori arrel del projecte

//Configuració de l'aplicació
define('APP_NAME', 'Assigning courses'); //nom de l'aplicació
define('TIME_ZONE', 'Europe/Madrid'); //zona horaria
define('MAX_COURSES_PER_EMPLOYEE', 3); //número de cursos màxims per persona
define('MAX_HOURS_PER_EMPLOYEE', 120); //número d'hores per persona entre tots els cursos
define('MAX_HOURS_PER_COURSE', 100); //número d'hores màxim per curs 

?>