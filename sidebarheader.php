<header class="CommonHeader">
    <script>
        function Logout(){
            window.location = "./Logout.php";
        }
    </script>

    <!-- <h1 class="name">Collins Aerospace</h1>
     <nav>
        <ul>
            <li>Home</li>
            <li onclick="Logout()">Logout</li>
        </ul>
        <!-- <input class="searchbar" type="text" id="Name" name="Name" placeholder="Search">  -->
    </nav>  -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="CompanyName" href="#">Collins Aerospace</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
</header>

<style>
    .CompanyName{
        font-size: 19px;
        font-weight: bold;
        color: black;
    }
</style>