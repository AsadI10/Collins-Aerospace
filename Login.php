<title>Login</title>

<h1>Login </h1><br>
<div class="logindiv">
	<fieldset action="index.php" method="POST">
		<legend>Login</legend><br>
		<label class="loginlabel" for="">Username: </label>
		<input name="Username" type="text" value="hallam"><br><br>
		<label class="loginlabel" for="">Password:</label> 
		<input name="Password" type="password" value="9JS(g8Zh"><br><br>
		<input class="Loginbutton" type="submit" value="Login">
</fieldset>
</div>

<style>
	fieldset{
		border: solid 4px grey;
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
	.loginbutton{
		font-size: 20px;
		width: 200px;
	}
</style>