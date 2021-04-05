<?php

    $dbname = 'wapDB';
    $host = 'localhost';
    $pass = '';
    $user = 'root';

    $connect = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");

?>