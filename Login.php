<?php
	require_once("SessionMaster.php");

	if(isset($_SESSION["APIInterface"])){
		header("Location: ./index.php");
	}
?>

<title>Login</title>

<!-- <nav>
	<img class="cllogo" src="img/collins-aerospace-logo-vector.png">
</nav> -->

<!-- <h1>Login</h1><br> -->
<fieldset class="logindiv">
	<legend>Login</legend>
<form action="index.php" method="POST">
		<label class="loginlabel" for="">Username: </label>
		<input name="Username" type="text" value="hallam"><br><br>
		<label class="loginlabel" for="">Password:</label> 
		<input name="Password" type="password" value="9JS(g8Zh"><br><br>
		<input class="Loginbutton" type="submit" value="Submit">
	</form>
</fieldset>
<style>
/* ------added new stuff-------  */
	body {
  background: #ABCDEF;
  font-family: Assistant, sans-serif;
  display: flex;
  min-height: 90vh;
}
.logindiv{
	 color: white;
  background: #136a8a;
  background: 
    -webkit-linear-gradient(to right, #267871, #136a8a);
  background: 
    linear-gradient(to right, #267871, #136a8a);
  margin: auto;
  box-shadow: 
    0px 2px 10px rgba(0,0,0,0.2),
    0px 10px 20px rgba(0,0,0,0.3), 
    0px 30px 60px 1px rgba(0,0,0,0.5);
  border-radius: 8px;
  padding: 50px;
}

	fieldset{
		border: solid 4px grey;
		background: ;
        /* width: 50%;  */
        margin: 0 auto;
		border-radius: 10px;
	}
	input[type=text]{
		margin-left:2px
	}
	input[type=password]{
		margin-left:5px;
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
		text-align: center;
	}
	body{
		background: #2d545e;
	}
	h1{
		font-weight: bold;
		margin: 0 auto;
		width: 6%;
		color: white;
	}
	div {
		background: ;
        width: 90%; 
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
		/* display: block;
  		margin-left: auto;
 		margin-right: auto; */
		cursor: pointer;
		position: absolute;
		margin-top: 10px;
		margin-left:50px;
	}
</style>