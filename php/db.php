
<?php
    
    #TABLES
    
    #CREATE TABLE RESULT(CONTESTNUMBER INT, VOTE TEXT NOT NULL);
    
    #CREATE TABLE State (enabled TEXT);
    
    #CREATE TABLE USERS(ID INTEGER PRIMARY KEY AUTO_INCREMENT, NAME char(100) UNIQUE NOT NULL, PASSWORD TEXT, FBID BIGINT, MELLOTOKEN TEXT);
    
    #CREATE TABLE uservotes (userid integer not null, contestnumber integer, vote text not null);
    
    $dbh  = new PDO('mysql:host=127.0.0.1;dbname=mello;charset=utf8', "root", "root") or die("cannot open the database");
?>
