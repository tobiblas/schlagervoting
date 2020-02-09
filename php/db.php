
<?php

    #TABLES

    #CREATE TABLE RESULT(CONTESTNUMBER INT, VOTE TEXT NOT NULL);
    #CREATE TABLE State (enabled TEXT);
    #CREATE TABLE USERS(ID INTEGER PRIMARY KEY AUTO_INCREMENT, NAME char(100) UNIQUE NOT NULL, PASSWORD TEXT, FBID BIGINT, MELLOTOKEN TEXT);
    #CREATE TABLE uservotes (userid integer not null, contestnumber integer, vote text not null);
    #CREATE TABLE song (CONTESTNUMBER INT, STARTNUMBER INT, Artist TEXT NOT NULL, Title TEXT NOT NULL);

    $dbh  = new PDO('mysql:host=127.0.0.1;dbname=mello2020;charset=utf8', "root", "root") or die("cannot open the database");
?>
