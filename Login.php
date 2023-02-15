<title>Login</title>

<nav>
	<img class="cllogo" src="img/collins-aerospace-logo-vector.png">
</nav>
<h1>Login</h1><br>
<fieldset class="logindiv">
	<legend>Login</legend>
<form action="index.php" method="POST">
		<label class="loginlabel" for="">Username: </label>
		<input name="Username" type="text" value="hallam"><br><br>
		<label class="loginlabel" for="">Password:</label> 
		<input name="Password" type="password" value="9JS(g8Zh"><br><br>
		<input class="Loginbutton" type="submit" value="Login">
	</form>
</fieldset>


<style>
	fieldset{
		border: solid 4px grey;
		background: ;
        width: 50%; 
        margin: 0 auto;
	}
	nav{
		background-color: white;
	}
	.cllogo{
		width: 16%;
	}
	legend{
		font-size: 30px;
		color: white;
		font-weight: bold;
	}
	body{
		background: #2d545e;
	}
	h1{
		font-weight: bold;
		margin: 0 auto;
		width: 8%;
		color: white;
	}
	div {
		background: ;
        width: 50%; 
        margin: 0 auto; 
    }
	.loginlabel{
		font-size: 19px;
		color: white;
		font-weight: bold;
	}
	.Loginbutton{
		font-size: 20px;
		width: 200px;
		display: block;
  		margin-left: auto;
 		margin-right: auto;
		cursor: pointer;
	}
</style>