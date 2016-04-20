<?php 

return array(
	"ALL_USERS" 		=> 	"SELECT users.id, users.username, users.password, enterprise.name AS enterprise FROM users 
							INNER JOIN enterprise ON users.id_enterprise = enterprise.id",
	"ALL_EMPLOYEES" 	=> 	"SELECT employees.id, employees.name, employees.surname, categories.name AS category,
							employees.dni, employees.email FROM employees INNER JOIN categories ON categories.id = employees.id_category",
	"ALL_COURSES"		=>	"SELECT courses.id, courses.name, courses.hours, courses.start_date, themes.name as theme, enterprise.name AS enterprise 
							FROM courses INNER JOIN themes ON courses.id_theme = themes.id INNER JOIN enterprise",
	"ALL_CATEGORIES"	=>	"SELECT categories.id, categories.name, categories.cost_hour FROM categories",
	"ALL_THEMES"		=>	"SELECT themes.id, themes.name, categories.name AS category FROM themes INNER JOIN categories ON categories.id = themes.id_category"

);

?>