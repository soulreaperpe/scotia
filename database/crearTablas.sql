/*	Crear tabla de proyectos
*/
CREATE TABLE `scotia`.`proyectos` ( 
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , 
	`nombre` VARCHAR(255) NOT NULL , 
	`inicio` DATE NULL , `fin` DATE NULL , 
	`created_at` TIMESTAMP NULL , 
	`updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`(10))) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;


//proyectos
            $table->increments('id');
            $table->string('nombre');
            $table->date('inicio');
            $table->date('fin');
            $table->timestamps();


//turnos
            $table->increments('id');
            $table->string('codigo');
            $table->string('descripcion');
            $table->timestamps();



//empleados            
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombres');
            $table->string('apellidos');
            $table->boolean('activo');
            $table->timestamps();



//marcacions            
            $table->increments('id');
            $table->integer('idEmpleado');
            $table->integer('idTurno');
            $table->dateTime('entrada');
            $table->dateTime('salida');
            $table->integer('minutosTardanza');
            $table->integer('horasEfectivas');
            $table->integer('minutosEfectivos');
            $table->timestamps();