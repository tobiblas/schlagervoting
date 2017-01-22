<?php
    include("db.php");
    
    $name = $_POST['name'];
    $pass = $_POST['password'];
    $new = $_POST['new'];
    
    $error = ""; #no error
    
    $token=getGUID();
    
    if ($new == 'true') {
        
        $sql ="select name from users where lower(name)='" . strtolower($name) . "';";
        foreach ($dbh->query($sql) as $row)
        {
            $error = "User already exists";
        }
        if ($error == "") {
            $sql = "insert into users (name, password, mellotoken) values ('" . $name . "','" . sha1($pass) . "','" . $token . "');";
            
            if (!$dbh->query($sql)) {
                $error = "server error";
            }
        }
        
    } else {
        $sql = "select password from users where name='" . $name . "';";
        foreach ($dbh->query($sql) as $row)
        {
            $password = $row[0];
            if (sha1($pass) != $password) {
                $error = "incorrect password";
            } else {
                #login ok!
            }
        }
        #what if users does not exist?
    }
    
    if ($error != "") {
        echo "error:" . $error;
    } else {
        echo $token;
    }
    
    
    function getGUID(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
            return $uuid;
        }
    }

    ?>