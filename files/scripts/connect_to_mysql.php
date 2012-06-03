<?php  
/* Created by Adam Khoury @ www.developphp.com */

// Place db host name. Sometimes "localhost" but  
// sometimes looks like this: >>      ???mysql??.someserver.net 
$db_host = "place_your_db_host"; 
// Place the username for the MySQL database here 
$db_username = "place_your_username";  
// Place the password for the MySQL database here 
$db_pass = "place_your_db_password";  
// Place the name for the MySQL database here 
$db_name = "place_your_db_name"; 

// Run the connection here   
$myConnection = mysqli_connect("$db_host","$db_username","$db_pass", "$db_name") or die ("could not connect to mysql");  
// Now you can use the variable $myConnection to connect in your queries      
?> 