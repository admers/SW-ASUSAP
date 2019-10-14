<?php
	/*===========================================
	|  Datos del servidor - Data of the server  |
	===========================================*/
	const SERVER="localhost";
	const DB="dbasusap";
	const USER="root";
	const PASS="kevin123";


	// Solo modificar la siguiente línea en caso el gestor de base de datos no sea MySQL
	//Only modify the following line in case the database manager is not MySQL
	const SGBD="mysql:host=".SERVER.";dbname=".DB;



	/*===========================================
	| Datos de la encriptacion - Encryption data |
	===========================================*/
	const METHOD='AES-256-CBC';
	const SECRET_KEY='$SRCE@2017';
	const SECRET_IV='101712';