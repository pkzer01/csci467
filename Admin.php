<!DOCTYPE html>
<html>
<head>
   <title>Associate Information</title>
   <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
         }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #4CAF50;
             color: white;
        }
         .btn-delete {
            background-color: #f44336;
            color: white;
         }
    </style>
 </head>
<body>

<?php
// Your database connection code here
$servername = 'course';
$username = 'z1915336';
$password = '2003Jun21';
$database = 'z1915336';

$dsn = "mysql:host=$hostname;dbname=$dbname";

  $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
                                                                                                                                                                              6,1           Top

