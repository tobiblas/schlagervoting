
<script>

var newUser = true;

function setupSignin() {
    newUser = false;
    var loginButton = document.getElementById("loginButton");
    loginButton.innerHTML = "Log in";
    var or = document.getElementById("or");
    var facebook = document.getElementById("facebookContainer");
    var signin = document.getElementById("setupSignin");
    signin.style.display = 'none';
    or.style.display = 'none';
    facebook.style.display = 'none';
}

</script>

<div class="signupcontainer">

<div class="row">
<div class="col-12 center">
<input id="nameinput" type="text" placeholder="First name"><br/>
</div>
</div>
<div class="row">
<div class="col-12 center">
<input id="passwordinput" type="password" placeholder="Password">
</div>
</div>

<div class="row">
    <div class="col-12" >
        <div class="signUpButton">
            <button id="loginButton" style="width:200px;" onclick="nameEntered(newUser)">Sign up</button>
        </div>
    </div>
</div>

<div class="row">
<div class="col-12 center">
<div id="setupSignin">
Already have an account? <a class="underlined" href="#" onclick="setupSignin();">Log in</a>
</div>
</div>
</div>


<!--<div class="or" id="or">
--------------------------------- OR ---------------------------------
</div>
<br>

<div class="row" id="facebookContainer">
<div class="col-12 center">
<?php echo '<a href="' . htmlspecialchars($loginUrl) . '"><img src="images/facebook-login-button.png" width="200px"/></a>'; ?>
</div>
</div>

-->


</div>
