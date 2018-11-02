/*	Crear tabla de proyectos
*/
CREATE TABLE `scotia`.`proyectos` ( `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , `nombre` VARCHAR(255) NOT NULL , `inicio` DATE NULL , `fin` DATE NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`(10))) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;