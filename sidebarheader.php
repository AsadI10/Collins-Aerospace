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
    <a class="CompanyName" href="#">Aerospace Discovery</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        <p>test</p>
      </li>
      <li>
        <a class="nav-link" href="/collins-Aerospace/Help.php">Help</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="Logout()">Logout</a>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
</header>

<style>
    .CompanyName{
        font-size: 25px;
        font-weight: bold;
        color: black;
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