<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- Fetching Existing Data -->
<?php
    $SearchQueryParameter = $_GET["username"];
    global   $ConnectingDB;
    $sql    =  "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
    $stmt   =  $ConnectingDB->prepare($sql);
    $stmt   -> bindValue(':userName', $SearchQueryParameter);
    $stmt   -> execute();
    $Result = $stmt->rowcount();
if( $Result==1 ){
  while ( $DataRows   = $stmt->fetch() ) {
    $ExistingName     = $DataRows["aname"];
    $ExistingBio      = $DataRows["abio"];
    $ExistingImage    = $DataRows["aimage"];
    $ExistingHeadline = $DataRows["aheadline"];
  }
}else {
  $_SESSION["ErrorMessage"]="Bad Request !!";
  Redirect_to("Blog.php?page=1");
}


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <title>Profile</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="http://adeyinka.000webhostapp.com" class="navbar-brand"> AdetunjiAdeyinka.com</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Blog.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link"></a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
          <input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
          <button  class="btn btn-primary" name="SearchButton">Go</button>
          </div>
        </form>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          <h1><i class="fa fa-user text-success mr-2" style="color:#27aae1;"></i><?php echo $ExistingName; ?></h1>
          <h3><?php echo $ExistingHeadline; ?></h3>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-md-3">
          <img src="images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
        </div>
        <div class="col-md-9" style="min-height:400px;">
          <div class="card">
            <div class="card-body">
              <p class="lead"> <?php echo $ExistingBio; ?> </p>
            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Theme By | Adetunji Adeyinka | <span id="year"></span> &copy; ----All right Reserved.</p>
          <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="http://adeyinka.000webhostapp.com" target="_blank"> This site is owned by &trade; adeyinka.000webhostapp.com</a></p>
           </div>
         </div>
      </div>
    </footer>
        <div style="height:10px; background:#27aae1;"></div>
    <!-- FOOTER END-->

  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<script>
  $('#year').text(new Date().getFullYear());
</script>
</body>
</html>
