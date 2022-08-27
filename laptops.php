<?php
$servername='localhost';
$dbname='techbuyecommerce';
$username='root';
$password='';
$dsn='mysql:host='.$servername.';dbname='.$dbname;
try{
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ATTR_ERRMODE);
    // echo "Connection established successfully";
    $stmt='SELECT * FROM products WHERE featured =:featured';
    $featured=1;
    $stmt=$conn->prepare($stmt);
    $stmt->bindParam(':featured',$featured);
    $stmt->execute();

}catch(Exception $ex){
    echo "Connection failure".$ex->getMessage();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="includes/css/bootstrap.min.css">
    <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">TechBuy.com</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Laptops</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Phones</a>
        </div>
      </li>
    
    </ul>
   
  </div>
 
</nav>
<div class="col-md-8">
    <div class="row">
        <h2 class="text-center">Top Products</h2>
        <div class="col-md-5">
            <?php
            $rows=$stmt->fetchAll(PDO::FETCH_OBJ);
            $x=0;
            foreach($rows as $row){
              ?>
              <h4><?= $row->title?></h4>
              <img src="<?= $row->image ?>" alt="<?= $row->title ?>" class="img-fluid">
              <span class="lprice"><?= $row->price ?></span><br>
              <a href="laptopdetails.php"><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#details-1">VIEW MORE DETAILS</button></a>
              <?php
                $x++;
            }
        
            ?>
        </div>
    </div>

  </div>
</body>
</html>