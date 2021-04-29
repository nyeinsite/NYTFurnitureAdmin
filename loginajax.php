<?php
session_start();
$login='';
$loginsuccess=false;
$con=mysqli_connect("localhost","root","","furniture");
$username='';
$password='';
if(isset($_REQUEST["btn"])){
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT * from staff";
$result=mysqli_query($con,$sql);
while($data=mysqli_fetch_array($result)){
if($username==$data[2] && $password==$data[3]){
  $loginsuccess=true;
$login='Admin';
$_SESSION['admin']='Admin';

}
}
if($loginsuccess==true){
  echo $login;
 

}else{
  echo "";
}

}

 ?>
