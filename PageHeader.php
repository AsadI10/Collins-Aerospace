<header class="CommonHeader">
    <script>
        function Logout(){
            window.location = "./Logout.php";
        }
    </script>
<br>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <h1 class="CompanyName" href="">Aerospace Discovery</h1>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li>
        <a class="nav-link" href="Help.php">Help</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="Logout()">Logout</a>
      </li>
    </ul>
  </div>
  <!-- added image on the right  -->
  <img class="logo "src="https://cdn.discordapp.com/attachments/1064837575375851621/1082612530616209418/SHU_Discover_official_logo.png" width="10%">
</nav>
</header>

<style> 
.logo{
  cursor:pointer;
}
   .CompanyName{
        font-size: 25px;
        font-weight: bold;
        color: black;
        cursor:pointer;
    }
    nav ul li{
        font-size: 20px;
        font-weight: bold;
        background-color: #f8f9fa; 
        padding-left: 10px 10px 10px;
        display: inline;
        font-size: 17px;
        font-weight: bold;
        font-family: 'Courier New', Courier, monospace; 
    }
    .navbar-light .navbar-nav .nav-link{
        color: black;
        font-weight: bold;
    }
    
</style>