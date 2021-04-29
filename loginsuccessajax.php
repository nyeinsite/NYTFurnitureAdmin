<?php
$login='';
$loginsuccess=false;
$con=mysqli_connect("localhost","root","","furniture");
$username='';
$password='';
if(isset($_REQUEST["btn"])){
$username=$_POST['username'];
$password=$_POST['password'];
$query="SELECT * from customer";
$result=mysqli_query($con,$query);
while($data=mysqli_fetch_array($result)){
  if($data[7]==$username && $data[8]==$password){
$login=$data[7];
$loginsuccess=true;
}
}
if($loginsuccess==true){
  echo "Login Success";
}else{
  echo "Login Fail Please Register";
}
}

 ?>
