<?php
require 'config.php';
require_once 'steamauth/steamauth.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?=$groupName?> Admin Application</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:300|Oswald|Playfair+Display|Press+Start+2P|Raleway|Roboto|Roboto+Condensed|Slabo+27px" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
    
<body>
<?php include('includes/nav.php'); ?>
    <?php
    if(!isset($_SESSION['steamid'])){
        include('includes/notice.php');
    }
    else{
        include('includes/application.php');
    }
    ?>
    
    <?php include('includes/footer.php'); ?>
</body>
    
</html>