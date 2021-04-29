<?php
session_start();
if(isset($_REQUEST['destroy'])){
unset($_SESSION['user']);
session_destroy();
unset($_SESSION['logout']);
session_destroy();

}
$order='';
$orderid='';
$deliveryid='';
$date='';
$agent='';
$id='';
$con= mysqli_connect("localhost", "root", "", "furniture");
include "autoid.php";
$id=autoID("delivery","DeliveryID","D_",10,"D_0000000001");
if(isset($_REQUEST["orderid"])){
$orderid=$_REQUEST["orderid"];}
if(isset($_POST["deliverysubmit"])){
    $order=$_POST["txtorderid"];
    $deliveryid=$_POST["txtdeliveryid"];
    $date=$_POST["deliverydate"];
    $agent=$_POST["deliveryagent"];
    $query="insert into delivery values ('$deliveryid','$date','$agent')";
    mysqli_query($con,$query);
    $deliver="Deliver";
    $query2="UPDATE orderfurniture SET Status='$deliver' wHERE OrderNo='$order'";
    mysqli_query($con,$query2);
    header("location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/formsignin.css">
    <link rel="stylesheet" type="text/css" href="css/formstyle.css">
  </head>
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
        <?php if(!isset($_SESSION['admin'])){?>
        <div class="row">
          <div class="col-md-12">
            <div class="signin"> 
              <a href="#" data-target="#login-modal" data-toggle="modal" >Login
              </a>
            </div>
          </div>
        </div>
        <?php }?>
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
    <form action="delivery.php" method="post">
      <div class="container ">
        <div class="row text-center">
          <div class="col-md-12">
           
          </div>
          <div class="col-md-6">
          </div>
        </div>
        <div clas="row">
       
        </div>
        <div class="row ">
          <div class="col-lg-2"> 
          </div>
          <div class="col-lg-8">
            <div id="ui">
              <h1 class="text-center">Customer Registration Form
              </h1>
              <form class="form-group text-center">
                
                <div class="row">
                  <div class="col-lg-6">
                    <label>Order Id:
                    </label>
                    <input type="text" name="txtorderid" class="form-control"
                       placeholder="Enter your ID...." value="<?php echo $orderid;?>" readonly="true" required="required">
             
                  </div>
                  <div class="col-lg-6">
                    <label>Delivery Id:
                    </label>
                    <input type="text" name="txtdeliveryid" class="form-control"
                       placeholder="Enter your ID...." value="<?php echo $id;?>" readonly="true" required="required">
               
                  </div>
                </div><br><br>
                <div class="row">
                  <div class="col-lg-6">
               
                    <label>Agent Name:
                    </label>
                    <select name="deliveryagent" class="form-control" required="required">
                    <?php $query="select * from deliveryagent";
                  $result=mysqli_query($con,$query);
                  while($data=mysqli_fetch_array($result)){
                  ?>
                      <option value="<?php echo $data[0];?>"><?php echo $data[1];?>
                      </option>
                  <?php }?>
                    </select>
                    
                  </div>
                  <div class="col-lg-6">
                    <label>Delivery Date:
                    </label>
                    <input type="date" name="deliverydate" class="form-control" required="required"> 
                   
                  </div>
                </div>
                <br>
               
                <div class="row text-center"> 
                  <input type="submit" name="deliverysubmit" value="Save"
                         class="btn btn-primary btn-block btn-lg">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </form>
    <br>
    <br>
    <div class="row">
      <div class="footer">
        <div class="innterfooter">
          <div class="footeritems">
            <h1>Giving Best Services
            </h1>
            <p>Our Paradise Furniture Company Branches Are Giving Your Choice
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

  </body>
</html>