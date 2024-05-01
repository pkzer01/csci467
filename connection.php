<?php
    // this file contains user-specific database login information

    // database connection code here
    $hostname = 'courses';
    $username = 'z1956079';
    $password = '2000Mar21';
    $dbname   = 'z1956079';

    //connect to MARIA DB/////////////////////////////////////////////
    $dsn = "mysql:host=$hostname;dbname=$dbname";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try{
	    $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        die("<p>Connection to database failed: {$e->getMessage()}</p>\n");
    }
    /*********************************************************************/
?>