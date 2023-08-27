<?php
$host="localhost";
$user="root";
$password="";
$db="prototype_database";
session_start();
$conn=mysqli_connect($host,$user,$password,$db);
if($conn===false)
{
    die("connection error");
}
// else {
//     echo 'kongrats';
// }
// ?>