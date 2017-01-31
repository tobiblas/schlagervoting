<?php
    require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';
    session_start();
    
?>
<html>
<head>
<title>Schlager</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">


<link rel="stylesheet" href="styles.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

<script src="http://rubaxa.github.io/Sortable/Sortable.js"></script>





<?php
    include("db.php");
    
    #check if we are logged in
    $logged_in = false;
    if (isset($_COOKIE["melloToken"])) {
        $logged_in = true;
    }
    
    $fb = new Facebook\Facebook([
                                'app_id' => '1615633848746410', // Replace {app-id} with your app id
                                'app_secret' => 'c6105888a635b10a5800f1f261d80e34',
                                'default_graph_version' => 'v2.2',
                                ]);
    
    $helper = $fb->getRedirectLoginHelper();
    
    $permissions = []; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://84.217.38.36:8081/mello/fb_callback.php', $permissions);
   ?>

<script>

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function saveList(vote, sortable, contestnumber)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            if ( xmlHttp.status == 200 && xmlHttp.responseText.trim() == 'CLOSED') {
                alert("Voting is closed.");
                window.location.href = window.location.href;
            } else if ( xmlHttp.status != 200) {
                alert("Something went wrong. Please try again.");
                window.location.href = window.location.href;
            } else {
                var order = sortable.toArray();
                localStorage.setItem(sortable.options.group, order.join('|'));
            }
        }
    }
    
    var query = "save.php?token=" + getCookie("melloToken") + "&vote=" + vote + "&contestnumber=" + contestnumber;
    xmlHttp.open("GET", query, true); // true for asynchronous
    xmlHttp.send(null);
}

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function eraseCookie( name ) {
    document.cookie = name +'=; Path=/mello; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function logout() {
    eraseCookie('melloToken');
    eraseCookie('melloName');
    location.reload();
}

function login(name, password, newUser)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4) {
            if ( xmlHttp.status == 200) {
                var resp = xmlHttp.responseText.trim();
                if (resp.includes("error")) {
                    alert(resp);
                } else {
                    createCookie("melloToken", resp, 1000);
                    location.reload();
                }
            } else if ( xmlHttp.status != 200) {
                alert("Something went wrong. Please try again.");
            }
        }
    }
    
    xmlHttp.open("POST", "login.php", true); // true for asynchronous
    var parameters="name="+name+"&password="+password+"&new="+newUser;
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send(parameters);
}

function nameEntered(newUser) {
    var name = document.getElementById("nameinput").value;
    if (name == null || name.trim() == "" || name.length < 2) {
        alert("Invalid name. Please enter a name with at least 2 characters");
    } else {
        var pass = document.getElementById("passwordinput").value;
        if (pass == null || pass.trim() == "" || pass.length < 4) {
            alert("Invalid password. Please enter a password with at least 4 characters");
        } else {
            login(name, pass, newUser);
        }
    }
    
}

</script>



</head>

<body>

<div class="row">
    <div class="col-12">
        <img src="images/header_melodifestivalen2.jpg" id="img1" />
    </div>

    <div class="logoutbutton" <?php if (!$logged_in) { echo "style='visibility:hidden;'"; } ?> >
        <a href="" onclick="logout();" style="color: white;">Logga ut</a>
    </div>

    <div class="menu-items" <?php if (!$logged_in) { echo "style='visibility:hidden;'"; } ?> >
        <button class="col-6 menu-item" onClick="window.location='index.php'">DELTÄVLINGAR</button>
        <button class="col-6 menu-item" onClick="window.location='?page=result'">RESULTAT</button>
    </div>
</div>


<?php
    if ($logged_in) {
        $page = $_GET['page'];
        if ($page == null) {
            include("start.php");
        } else if ($page == "result") {
            include("result.php");
        } else if ($page == "points") {
            include("points.php");
        } else if ($page == "contest") {
            include("contest.php");
        } else if ($page == "comparison") {
            include("comparison.php");
        }
    } else {
        include("enter_name.php");
    }
?>

<script>

    function load() {
        if (!window.location.search.substr(1).includes("page=contest")) {
            return;
        }
        setTimeout(
            function() {
                var imageHeight = document.getElementById('image1').clientHeight;
                console.log("imageHeight", imageHeight)
                   
                document.getElementById('final').style.height = imageHeight * 2 + 'px';
                document.getElementById('second-chance').style.height = imageHeight * 2 + 'px';
                document.getElementById('looser').style.height = imageHeight * 3 + 'px';
            }, 300);
    }

    window.onload = load();

</script>


</body>
</html>
