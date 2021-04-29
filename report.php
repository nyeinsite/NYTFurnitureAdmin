<?php
session_start();
if(isset($_REQUEST['destroy'])){
unset($_SESSION['admin']);
unset($_SESSION['logout']);
}
$type='';$startdate='';$enddate='';
$con = mysqli_connect("localhost", "root", "", "furniture");
$sql='';
$result='';
$data='';
if(isset($_REQUEST['report'])){
   $type=$_REQUEST['type'];
   if(isset($_REQUEST['startdate']))
   $startdate=$_REQUEST['startdate'];
   if(isset($_REQUEST['enddate']))
   $enddate=$_REQUEST['enddate'];
 if($type=='purchase'){
     $type='purchase';
 }
 else if($type=="order"){
     $type='order';
 }else{
     $type='totalsale';
 }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Report Form
    </title>
    <link rel="stylesheet" href="css/bootstrap.css" class="css">
    <link rel="stylesheet" href="css/formstyle.css" class="css">
  </head>
  <body><nav class="navbar navbar-expand-lg  navbar navbar-dark" style="background-color:#b8b8b1;">
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
    <form action="report.php" method="post">
      <div class="container ">
        <div class="row text-center">
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
              <h1 class="text-center">Furniture Report Form
              </h1>
              <form class="form-group text-center">
               
                <div class="row">
                  <div class="col-md-12">
                    <label>Type:
                    </label>
                    <select name="type" class="form-control">
                      <option value="purchase">Purchase
                      </option>
                      <option value="order">Order
                      </option>
                      <option value="totalsale">Total Sale
                      </option>
                     
                    </select>
                    
                  </div>
                
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label>Start Date:
                    </label>
                    <input type="date" name="startdate" class="form-control"
                         required>
                   
                  </div>
                  
                  </div>
                  
                  <div class="row">       
                   <div class="col-md-12">
                    <label>End Date:
                    </label>
                    <input type="date" name="enddate" class="form-control"
                          required >
                   
                  </div>
                </div>
                <div class="col-md-6" style="margin-left:140px;">
                      <button name="report" type="submit" class="btn btn-primary btn-lg btn-block">Search
                      </button>
                    </div>
                </div>
                <br>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php if($type=='purchase'){
        ?> <div class="container">
     <div class="row text-center" style="margin-left:120px;">
        <table style="width:900px; height:500px; overflow-y:auto;background-color:white;"
               class="table table-hover white">
          <tbody>
            <tr>
              <th scope="col"> PurchaseID:
              </th>
              <th scope="col">SupplierID:
              </th>
              <th scope="col"> Date
              </th>
              <th scope="col"> TotalAmount
              </th>
            </tr>

            <?php
$query = "SELECT * FROM purchase WHERE DATE BETWEEN '$startdate' AND '$enddate'";

$result = mysqli_query($con, $query);
while ($data = mysqli_fetch_array($result))
{
echo "<tr><td scope='row'>" . $data[0] . "</td><td scope='row'>" . $data[1] . "</td><td scope='row'>" . $data[2] . "</td><td scope='row'>" . $data[3] . "</td></tr>"; 
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
    <?php }?>
    <?php if($type=='order'){
        ?> <div class="container">
     <div class="row text-center" style="margin-left:120px;">
        <table style="width:900px; height:500px; overflow-y:auto;background-color:white;"
               class="table table-hover white">
          <tbody>
            <tr>
              <th scope="col"> OrderID:
              </th>
              <th scope="col">CustomerName:
              </th>
              <th scope="col"> DeliveryAddress:
              </th>
              <th scope="col"> Status
              </th>
            </tr>

            <?php
$query = "SELECT * FROM orderfurniture WHERE OrderDate BETWEEN '$startdate' AND '$enddate'";

$result = mysqli_query($con, $query);
while ($data = mysqli_fetch_array($result))
{
echo "<tr><td scope='row'>" . $data[0] . "</td><td scope='row'>" . $data[1] . "</td><td scope='row'>" . $data[2] . "</td><td scope='row'>" . $data[3] . "</td></tr>"; 
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
    <?php }?>
    <?php if($type=='totalsale'){
        ?> <div class="container">
     <div class="row text-center" style="margin-left:120px;">
        <table style="width:900px; height:500px; overflow-y:auto;background-color:white;"
               class="table table-hover white">
          <tbody>
            <tr>
              <th scope="col"> OrderID:
              </th>
              <th scope="col">FurnitureID:
              </th>
              <th scope="col"> TotalSale:
              </th>
              
            </tr>

            <?php
$query = "SELECT * FROM orderfurniture WHERE OrderDate BETWEEN '$startdate' AND '$enddate'";
$price=0;
$result = mysqli_query($con, $query);
while ($data = mysqli_fetch_array($result))
{$orderid=$data[0];
    $query2="SELECT * FROM orderdetail WHERE OrderNo= '$orderid' ";
    $result2=mysqli_query($con,$query2);
    while($data2=mysqli_fetch_array($result2)){
        $query3="SELECT * FROM orderdetail WHERE OrderNo= '$orderid' ";
        $result3=mysqli_query($con,$query2);
        while($data3=mysqli_fetch_array($result3))
        if($data2[1]==$data3[1])
       $price+=$data2[2]*$data2[3];
echo "<tr><td scope='row'>" . $data2[0] . "</td><td scope='row'>" . $data2[1] . "</td><td scope='row'>" . $price. "</td></tr>"; 
}}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
    <?php }?>
    
  </body>
</html>
