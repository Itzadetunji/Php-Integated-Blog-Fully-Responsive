<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php Confirm_Login(); ?>
<?php
$SarchQueryParameter = $_GET['id'];
// Fetching Existing Content according to our post
global $ConnectingDB;
$sql  = "SELECT * FROM posts WHERE id='$SarchQueryParameter'";
$stmt = $ConnectingDB ->query($sql);
while ($DataRows=$stmt->fetch()) {
  $TitleToBeDeleted    = $DataRows['title'];
  $CategoryToBeDeleted = $DataRows['category'];
  $ImageToBeDeleted    = $DataRows['image'];
  $PostToBeDeleted     = $DataRows['post'];
  // code...
}
// echo $ImageToBeDeleted;
if(isset($_POST["Submit"])){
    // Query to Delete Post in DB When everything is fine
    global $ConnectingDB;
    $sql = "DELETE FROM posts WHERE id='$SarchQueryParameter'";
    $Execute =$ConnectingDB->query($sql);
    //var_dump($Execute);
    if($Execute){
      $Target_Path_To_DELETE_Image = "Uploads/$ImageToBeDeleted";
      unlink($Target_Path_To_DELETE_Image);
      $_SESSION["SuccessMessage"]="Post DELETED Successfully";
      Redirect_to("Posts.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("Posts.php");
    }
} //Ending of Submit Button If-Condition
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
  <title>Delete Post</title>
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
          <a href="MyProfile.php" class="nav-link"> <i class="fa fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="Posts.php" class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
          <a href="Categories.php" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
          <a href="Admins.php" class="nav-link">Manage Admins</a>
        </li>
        <li class="nav-item">
          <a href="Comments.php" class="nav-link">Comments</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
          <i class="fa fa-user-times"></i> Logout</a></li>
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
          <div class="col-md-12">
          <h1><i class="fa fa-edit" style="color:#27aae1;"></i> Delete Post</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

     <!-- Main Area -->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="DeletePost.php?id=<?php echo $SarchQueryParameter; ?>" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
               <input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeDeleted; ?>">
            </div>
            <div class="form-group">
              <span class="FieldInfo">Existing Category: </span>
              <?php echo $CategoryToBeDeleted;?>
              <br>
            </div>
            <div class="form-group">
              <span class="FieldInfo">Existing Image: </span>
              <img  class="mb-1" src="Uploads/<?php echo $ImageToBeDeleted;?>" width="170px"; height="70px"; >
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Post: </span></label>
              <textarea disabled class="form-control" id="Post" name="PostDescription" rows="8" cols="80">
                <?php echo $PostToBeDeleted;?>
              </textarea>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fa fa-arrow-left"></i> Back To Dashboard</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-danger btn-block">
                  <i class="fa fa-trash"></i> Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>



    <!-- End Main Area -->
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
