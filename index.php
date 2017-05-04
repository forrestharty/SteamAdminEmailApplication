<?php
require 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$groupName?> Admin Application</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
</head>
    
<body>
    <header>
        <div class="container">
            <div class="pull-left">
                <h1><?=$groupName?></h1>
                <h3>Admin Application Form</h3>
            </div>
            <div class="pull-right">
                <img src="<?=$groupImageUrl?>" alt="<?=$groupName?> logo" height="148" width="148">
            </div>
        </div>
    </header>
    
    <main>
        <div class="container">
<?php
            
$name = ''; //applicant name
$id = ''; //applicant id
$visitorEmail = ''; //applicant email
$message = ''; //applicant resume
$recommender = ''; //admin recommender
$accesstoken_entry = ''; //to prevent spam
$nameError = ''; //init error messages
$idError = ''; //init error messages
$messageError = ''; //init error messages
$emailError = ''; //init error messages
$accessTokenError = ''; //init error messages

//on button press
if(isset($_POST['submit'])){

//setup variables from $_POST array
$name = $_POST['name'];
$id = $_POST['id'];
$visitorEmail = $_POST['email'];
$message = $_POST['message'];
$recommender = $_POST['recommender'];
$accesstoken_entry = $_POST['accesstoken_entry'];

//reinitialize error messages
$nameIsValid = true;
$emailIsValid = true;
$messageIsValid = true;
$tokenIsValid = true;
$idIsValid = true;
$nameError = '';
$idError = '';
$emailError = '';
$accessTokenError = '';
$mailDidSendToAllAdmins = false;
    
    //validate name
    if ($name == '') {
        $nameError = 'Please enter a name.';
        $nameIsValid = false;
    }
    else{
        $name = strip_tags($name);
    }
    
    //validate name
    if ($id == '') {
        $idError = 'Please enter a SteamID. (format STEAM_0:0:33870197)';
        $idIsValid = false;
    }
    else{
        $id = strip_tags($id);
    }
    
    if ($message == '') {
        $messageError = 'Please enter valid experience in the resume field.';
        $messageIsValid = false;
    }
    else{
        $message = strip_tags($message);
    }
    
    //validate email
    if (!filter_var($visitorEmail, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Invalid email format';
        $emailIsValid = false;
    }
    
    //validate token
    if($_POST['accesstoken_entry'] != $accesstoken){
        $accessTokenError = 'Please input a valid access token.';
        $tokenIsValid = false;
    }
    
    //if both vaild, send email
    if($emailIsValid && $tokenIsValid && $idIsValid && $messageIsValid){
        foreach($adminEmails as $recipient){
            $mail = mail($recipient, "Admin Application - $name", 'Applicant Name: ' . $name . "\n\nApplicant Steam ID: " . $id. "\n\nAdmin Recommendation: " . $recommender . "\n\nResumé: \n" . $message, $visitorEmail);
            if($adminEmailDebugger == 'on'){
                if($mail){
                    echo "<div class='well'>Email Sent to $recipient. Thank you!</div>";
                }
                else{
                    echo "<div class='well'>An error has occurred sending email to $recipient</div>";
                }
            }
            $mailDidSendToAllAdmins = $mail;
        }
        //check to see if last admin got email
        if($mailDidSendToAllAdmins){
            echo "<div class='well'>Email Sent. Thank you!</div>";
        }
        else{
            echo "<div class='well'>An error has occurred, and the email has not been sent.</div>";
        }
    }
    else{
        echo "<div class='jumbotron'>Please enter valid credentials.</div>";
    }
}
?>
            
            <form method="post" name="app" id="app">
                <div class="form-group">
                    <label for="name">
                        Name<span style='color:red;'>*</span>
                    </label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" required>
                    <span style='color:red;'><?= $nameError ?></span>
                </div>
                
                <div class="form-group">
                    <label for="id">
                        SteamID<span style='color:red;'>*</span>
                    </label>
                    <input type="text" class="form-control" name="id" id="id" value="<?= $id ?>" required>
                    <span style='color:red;'><?= $idError ?></span>
                    <small>Example - <a href="https://steamcommunity.com/id/jesushchristesq/" target="_blank">STEAM_0:0:33870197</a> - You can find it <a href="https://steamid.io/" target="_blank">here.</a></small>
                </div>
                
                <div class="form-group">
                    <label for=email>
                        Email Address<span style='color:red;'>*</span>
                    </label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= $visitorEmail ?>" required>
                    <span style='color:red;'><?= $emailError ?></span>
                </div>
                
                <div class="form-group">
                    <label for=resume>
                        Resumé<span style='color:red;'>*</span>
                    </label>
                    <p><?=$pageMessage?></p>
                    <textarea class="form-control" name="message" width="100%" maxlength="1000" required><?=$message ?></textarea>
                    <span style='color:red;'><?= $messageError ?></span>
                </div>
                
                <div class="form-group">
                    <label for="recommender">
                        Recommender
                    </label>
                    <select name="recommender" id="recommender" class="form-control">
                        <option value="None">None</option>
                    <?php 
                        foreach($adminRecommenders as $ar){
                            echo ('<option value="' . $ar . '">' . $ar . '</option>');
                        }
                    ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="accesstoken">
                        Access Token<span style='color:red;'>*</span>
                    </label>
                    <input type="text" class="form-control" name="accesstoken_entry" id="accesstoken" value="<?= $accesstoken_entry ?>" required>
                    <span style='color:red;'><?= $accessTokenError ?></span>
                </div>
                <button class="btn btn-success form-control" type="submit" name="submit" id="clickIt" value="Send Application">Send Application</button>
            </form>
            
        </div>
        
    </main>
    
    <footer class="container">
        <p class="pull-left">Copyright &copy; Forrest Harty 2017</p>
        <p class="pull-right">Using Bootstrap and JQuery</p>
    </footer>
</body>
    
</html>
