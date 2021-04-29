<?php
session_start();
$form=1;
$flag=false;
$i=0;
$savesuccess='';
$removeno=-1;
$con=mysqli_connect("localhost","root","","furniture");
include "autoid.php";
$purchaseid=autoID("purchase","PurchaseID","PU_",10,"PU_0000000001");
if(!isset($_SESSION['furnitureitems'])){
$_SESSION['furnitureitems']=array();
$_SESSION['furniturequantity']=array();
$_SESSION['furnitureprice']=array();
$_SESSION['furniturename']=array();
$_SESSION['price']=array();
$_SESSION['total']=0;
}
if(isset($_REQUEST['add'])  ){
if(isset($_REQUEST['furnitureid'])){
for($i=0;$i<count($_SESSION['furnitureitems']);$i++){
if($_SESSION['furnitureitems'][$i]==$_REQUEST['furnitureid']){
$flag=true;
$_SESSION['furniturename'][$i]=$_REQUEST['furniturename'];
$_SESSION['furniturequantity'][$i]+=$_REQUEST['furnitureqty'];
$_SESSION['furnitureprice'][$i]=$_REQUEST['furnitureprice'];
}
// $_SESSION['total']+=$_SESSION['furnitureprice'][$i];
}
if($flag==false){
$_SESSION['furnitureitems'][$i]=$_REQUEST['furnitureid'];
$_SESSION['furniturequantity'][$i]=$_REQUEST['furnitureqty'];
$_SESSION['furnitureprice'][$i]=$_REQUEST['furnitureprice'];
$_SESSION['furniturename'][$i]=$_REQUEST['furniturename'];
}
}
}
if(isset($_REQUEST['savedata'])){
$purchaseid=$_REQUEST['purchaseid'];
$supplierid=$_REQUEST['supplierid'];
$purchasedate=$_REQUEST['purchasedate'];
$total=$_REQUEST['total'];
$querysave="insert into purchase values('$purchaseid','$supplierid','$purchasedate','$total')";
mysqli_query($con,$querysave);
for($r=0;$r<count($_SESSION['furnitureitems']);$r++){
$furid=$_SESSION['furnitureitems'][$r];
$furqty=$_SESSION['furniturequantity'][$r];
$furprice=$_SESSION['furnitureprice'][$r];
$querydetail="insert into purchasedetail values('$purchaseid','$furid','$furqty','$furprice')";
mysqli_query($con,$querydetail);
$amount=$_SESSION['furniturequantity'][$r];
$furnitureamount="select * from furniture";
$resultamount=mysqli_query($con,$furnitureamount);
while($dataamount=mysqli_fetch_array($resultamount)){
if($_SESSION['furnitureitems'][$r]==$dataamount[0]){
$updateamount=(int)$dataamount[5]+$amount;
$updatequery="update furniture set quantity='$updateamount' where FurnitureID='$furid'";
mysqli_query($con,$updatequery);
}
}
$savesuccess="<h5 style='color:blue';>Successfully Save</h5>";
}
$totao=0;
unset($_SESSION['furnitureitems']);
unset($_SESSION['furniturequantity']);
unset($_SESSION['furnitureprice']);
unset($_SESSION['furniturename']);
}
if(isset($_REQUEST['cancel'])){
session_unset();
}
if(isset($_REQUEST['removeno'])){
$removeno=$_REQUEST['removeno'];
$_SESSION['furnitureitems'][$removeno]="";
$_SESSION['furniturename'][$removeno]="";
$_SESSION['furniturequantity'][$removeno]=0;
$_SESSION['furnitureprice'][$removeno]=0;
} 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>
    </title>
  </head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/formsignin.css">
  <link rel="stylesheet" type="text/css" href="css/formstyle.css">
  <link rel="stylesheet" type="text/css" href="css/purchase.css">
  <body>
    <nav class="navbar navbar-expand-lg  navbar navbar-dark" style="background-color:#b8b8b1;">
      <!--navbar-inverse bg-success-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
        </span>
      </button>
      <a  class="navbar-brand" href="#">
        <img src="img/logo.png" width="100" height="50" alt="" loading="lazy">
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if(isset($_SESSION['admin'])){?>    
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a style="color:black;font-family: "system-ui";" class="nav-link" href="home.php">Home 
              <span class="sr-only">(current)
              </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php" style="color:black;font-family: "system-ui";" id="msg">
            </a>
          </li>       
          <li class="nav-item">
            <a class="nav-link" href="home.php?destroy=1" style="color:black;font-family: "system-ui";" id="msg4">
            </a>
          </li>   
          <?php if(isset($_SESSION['admin'])){
?>
          <li class="nav-item active">
            <a style="color:black;font-family: 'system-ui';" class="nav-link dropdown-toggle" data-toggle="dropdown"  href="#">Entry
              <span class="sr-only">(current)
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <button class="dropdown-item" type="submit" id="showcustomer">All Customers
              </button>
              <button class="dropdown-item" type="submit" id="showsupplier">All Suppliers
              </button>
              <button class="dropdown-item" type="submit" id="showdeliveryagent">All Agents
              </button>
              <button class="dropdown-item" type="submit" id="showfurniture">All Furniture
              </button>
              <button class="dropdown-item" type="submit" id="showfurnituretype">All Furniture Types
              </button>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="home.php" style="color:black;font-family: "system-ui";" value="">
              <?php echo $_SESSION['admin'];?>
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="purchase.php" style="color:black;font-family: "system-ui";" value="">Purchase
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="deliveryprocess.php" style="color:black;font-family: "system-ui";" value="">Delivery
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="report.php" style="color:black;font-family: "system-ui";" value="">Report
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="feedback.php" style="color:black;font-family: "system-ui";" value="">Feedback
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="home.php?destroy=1" style="color:black;font-family: "system-ui";" >Logout
            </a>
          </li>  
          <?php }
}?> 
        </ul>
        <div class="modal fade" id="login-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <img src="img/logo.png" alt="" class="img-thumbnail"  id="img-logo">
              </div>
              <div id="div-forms">
                <div class="modal-body">
                  <span>Please Login Here;
                  </span>
                  <h4 id="msg2" style="color:red;">
                  </h4>
                  <h4 id="msg3" style="color:blue;">
                  </h4>
                  <input type="text" id="txtusername" class="form-control" placeholder="Username:" required>  
                  <input type="password" id="txtpassword" class="form-control" placeholder="password" required>
                  <div class="checkbox">
                    <label for="">
                      <input type="checkbox">Remember Me!
                    </label>
                  </div>  
                </div>
                <div class="modal-footer">
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" id="singin">Login
                      </button>
                    </div>
                    <div class="col-sm-6">
                      <button  type="submit" class="btn btn-primary btn-lg btn-block" id="signup">SignUp
                      </button>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>&nbsp;
      </div>
    </nav>
    <div class="row purchasetitle">
      <h1>Purchase
      </h1>
    </div>
    <div class="row purchasebody" style="height:500px;">
      <div class="col-md-4 purchasebodycol ">
        <form class="purchaseform" method="post" action="purchase.php">
          <div class="form-group ">
            <label for="exampleFormControlInput1">Purchase ID
            </label>
            <input type="text" class="form-control" name="purchaseid" id="exampleFormControlInput1" value="<?php echo $purchaseid;?>" readonly="true" required>
          </div>
          <div class="form-group" >
            <label for="exampleFormControlSelect1">SupplierName
            </label>
            <select class="form-control" name="supplierid" id="exampleFormControlSelect1">
              <?php $query1="select * from supplier";
$result1=mysqli_query($con,$query1);
while($data1=mysqli_fetch_array($result1)){
?>
              <option value="<?php echo $data1[0];?>">
                <?php echo $data1[1];?>
              </option>
              <?php }?>
            </select>
          </div>
          <div class="form-group ">
            <label for="exampleFormControlInput1">PurchaseDate
            </label>
            <input name="purchasedate" type="date" class="form-control" id="exampleFormControlInput1"  value="<?php echo date('Y-m-d'); ?>" readonly="true" required/>
          </div>
          <?php $total=0;
if(isset($_SESSION['furnitureitems'])){
for($c=0;$c<count($_SESSION['furnitureitems']);$c++){
$total+=$_SESSION['furniturequantity'][$c]*$_SESSION['furnitureprice'][$c];
}
?>
          <div class="form-group ">
            <label for="exampleFormControlInput1">TotalAmount
            </label>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $total;?>" readonly="true" name="total" required>
          </div>
          <?php }else if(!isset($_SESSION['furnitureitems'])){?>
          <div class="form-group ">
            <label for="exampleFormControlInput1">TotalAmount
            </label>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="0" name="total" readonly="true" required>
          </div>
          <?PHP }?>
          <button type="submit" name="savedata" class="btn btn-primary">Save Data
          </button>
          </a>
        <a href="purchase.php?cancel='1'">
          <button type="button" class="btn btn-default">Cancel
          </button>
        </a>
        <?php echo $savesuccess;?>
        </form>
    </div>
    <div class="col-md-8 purchasebodycol ">
      <div class="row purchasebodysection2">
        <div class="col">
          <h1>Furniture Information
          </h1>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-6  purchasebodysection3">
          <div class="row">
            <div class="col-md-6">
              <h4>Name
              </h4>
              <div class="form-group">
                <select multiple class="form-control" id="exampleFormControlSelect2" onchange="javascript:handleSelect(this)"  style="height:250px;">
                  <?php $query2="select * from furniture";
$result2=mysqli_query($con,$query2);
while($data2=mysqli_fetch_array($result2)){
?>
                  <option id="furnitureitem" function="selectitem()" value="<?php echo $data2[0];?>">
                    <?php echo $data2[1];?>
                  </option>
                  <?php }?>
                </select>
              </div>
            </div>
            <?PHP
if(isset($_REQUEST['item'])){
$furname=$_REQUEST['item'];
$query3="select * from furniture where FurnitureID='$furname'";
$result3=mysqli_query($con,$query3);
while($data3=mysqli_fetch_array($result3)){
?>
            <div class="col-md-6">
              <h4>
              </h4>
              <form class="purchaseform2" action="purchase.php" method="post"> 
                <div class="form-group ">
                  <label for="exampleFormControlInput1">Furniture ID
                  </label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $data3[0]; ?>" name="furnitureid" readonly="true"  required>
                </div>
                <div class="form-group ">
                  <label for="exampleFormControlInput1">furniture
                  </label>
                  <input type="text" class="form-control" id="exampleFormControlInput1"  value="<?php echo $data3[1];?>" name="furniturename" readonly="true" required>
                </div>
                <div class="form-group ">
                  <label for="exampleFormControlInput1">quantity
                  </label>
                  <input type="number" min="0" max="<?php echo $data3[5]; ?>" class="form-control" id="exampleFormControlInput1"  value="<?php echo $data3[5]; ?>" name="furnitureqty" required> 
                </div>
                <div class="form-group ">
                  <label for="exampleFormControlInput1">Price per 1
                  </label>
                  <input type="text" class="form-control" id="exampleFormControlInput1"  value="<?php echo $data3[3];?>" name="furnitureprice" readonly="true" required>
                </div>
                <?php 
}
}else{?>
                <div class="col-md-6">
                  <h4>
                  </h4>
                  <form class="purchaseform2" action="purchase.php" method="post">
                    <div class="form-group ">
                      <label for="exampleFormControlInput1">Furniture ID
                      </label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" name="furnitureid" required>
                    </div>
                    <div class="form-group ">
                      <label for="exampleFormControlInput1">furniture
                      </label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"  name="furniturename"  required>
                    </div>
                    <div class="form-group ">
                      <label for="exampleFormControlInput1">quantity
                      </label>
                      <input type="number" class="form-control" id="exampleFormControlInput1" name="furnitureqty" required>
                    </div>
                    <div class="form-group ">
                      <label for="exampleFormControlInput1">Price per 1
                      </label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" name="furnitureprice" required>
                    </div>
                    <?PHP }
?>
                    <button type="submit" name="add" class="btn btn-danger">Add
                    </button>
                    </a>
                  </form>
                </div>
            </div>
          </div>
          <div class="col-md-6  purchasebodysection3" >
            <div class="container">
              <div class="row text-center showtable">
                <table style="width:300px; height:300px; overflow-y:auto;background-color:white;"
                       class="table table-hover white">
                  <tbody>
                    <tr>
                      <th scope="col"> Furniture ID:
                      </th>
                      <th scope="col">Furniture Name
                      </th>
                      <th scope="col"> Quantity
                      </th>
                      <th scope="col"> Price
                      </th>
                    </tr>
                    <?php
if(isset($_SESSION['furnitureitems'])){
for($j=0;$j<count($_SESSION['furnitureitems']);$j++){
echo "<tr><td scope='row'>" . $_SESSION['furnitureitems'][$j] . "</td><td scope='row'>" .$_SESSION['furniturename'][$j] . "</td><td scope='row'>" . $_SESSION['furniturequantity'][$j] . "</td><td scope='row'>" . $_SESSION['furnitureprice'][$j] . "</td><td scope='row'><a href='purchase.php?removeno=".$j."'>Remove</td></tr>";
}}
?>              
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="footer">
        <div class="innterfooter">
          <div class="footeritems">
            <h1>Giving Best Services
            </h1>
            <p>Our NYT Furniture Company Branches Are Giving Your Choice
              Of Enjoyment
            </p>
          </div>
          <div class="footeritems">
            <h2>Services
            </h2>
            <div class="border">
            </div>
            <ul>
              <li> 
                <a href="#">30% Discount
                </a>
              </li>
              <li> 
                <a href="#">Free Delivery
                </a>
              </li>
              <li> 
                <a href="#">Lucky Draw
                </a>
              </li>
              <li> 
                <a href="#">Give Away
                </a>
              </li>
            </ul>
          </div>
          <div class="footeritems">
            <h2>Quick Links
            </h2>
            <div class="border">
            </div>
            <ul>
              <li> 
                <a href="#">Home
                </a>
              </li>
              <li> 
                <a href="#">Shop
                </a>
              </li>
              <li> 
                <a href="#">Blog
                </a>
              </li>
              <li> 
                <a href="#">Features
                </a>
              </li>
              <li> 
                <a href="#">About Us
                </a>
              </li>
              <li> 
                <a href="#">Contact Us
                </a>
              </li>
            </ul>
          </div>
          <ul>
            <li> 
              <a href="#">FaceBook
              </a>
            </li>
            <li> 
              <a href="#">Instagram
              </a>
            </li>
            <li> 
              <a href="#">Twitter
              </a>
            </li>
          </ul>
        </div>
        <div class="footerbottom">
          Design by Nyein Yadanar Tun (2020)
        </div>
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
  </script>
  <script src="js/style.js">
  </script>
  <script type="text/javascript" src="js/jquery.js">
  </script>
  <script type="text/javascript">
    function handleSelect(elm)
    {
      window.location = "purchase.php?item="+elm.value;
    }
  </script>
</html>
<script type="text/javascript">
  $("document").ready(function(e){
    $("#showcustomer").click(function(){
      window.location="showcustomer.php";
    }
                            );
    $("#showsupplier").click(function(){
      window.location="showsupplier.php";
    }
                            );
    $("#showdeliveryagent").click(function(){
      window.location="showdeliveryagent.php";
    }
                                 );
    $("#showfurnituretype").click(function(){
      window.location="showfurnituretype.php";
    }
                                 );
    $("#signup").click(function(){
      window.location="customer.php";
    }
                      );
    $("#showfurniture").click(function(){
      window.location="furniture.php";
    }
                             );
  }
                     );
</script>
