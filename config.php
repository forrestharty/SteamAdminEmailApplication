<?php
// !!!config!!!
            
$groupName = 'Example Name'; //put your group name here

$domain = 'example.com'; //put your domain for your homepage here, without http://

$ssl = false; //set this to true if you're using ssl (i.e. https://)

$groupImageUrl = 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/13/133094c5d59f9db87e77246ad748881b1c780f98_full.jpg'; //img link for group branding image. the image will resize to 148x148, but using a square image will still look nice

$pageMessage = 'Example Message <-- use this space to list what kind of qualifications you are looking for in an administraitor for your gaming community.'; //write desired qualifications here
            
$adminEmails = array('example1@gmail.com', 'example2@gmail.com'); // add admin's emails here, in single quotes separated by commas

$adminRecommenders = array('admin1', 'admin2');
            
$accesstoken = 'examplepasscode'; //set this as a hard to guess string, securing your form from spam

$apikey = ''; //get an Steam API key to use this script https://steamcommunity.com/dev/apikey

//--------------------------------------------------------------------------------------------------------------------------------------------------------

// !! !!            BELOW DANGEROUS SETTINGS BELOW           !! !!  //
//       PLEASE BE CAREFUL WHEN ENABLING THE EMAIL DEBUGGER         //
//       WHEN TURNED ON, THIS DEBUGGER WILL SHOW EVERY EMAIL        //
//       STORED IN $adminEmails, use responsibly, ONLY FOR          //
//       DEVELOPERS                                                 //
//                                                                  //

$adminEmailDebugger = 'off'; // 'on'||'off' check this to see which admins get emails, and which don't --- DISPLAYS SENSITIVE DATA, PLEASE USE WITH CAUTION

?>