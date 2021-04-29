<?php session_start()?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/formsignin.css">
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
    </script>
  </body>
</html>
<?php
$con = mysqli_connect("localhost", "root", "", "furniture");
$formtype = 0;
$id = "";
$name = "";
$flag = true;
$editflag = true;
$seeall = 0;
$eid = '';
$ename = '';
$editid = '';
$editname = '';
$alreadyexist = '';
//-----------------------------------------------------------------------------------Auto ID Test--------------------------------------------------------------------------------------
include "autoid.php";
$id=autoID("furnituretype","FurnitureTypeID","FT_",10,"FT_0000000001");
//-------------------------------------------------------------Delete Furniture Type-----------------------------------------------------------------------------------------
if (isset($_REQUEST['did']))
{
$did = $_REQUEST['did'];
$query = "DELETE from furnituretype where FurnitureTypeID='$did'";
mysqli_query($con, $query);
$seeall = 1;
}
//--------------------------------------------------------------Update Furniture Type----------------------------------------------------------------------------------
if (isset($_POST['edit']))
{
$formtype = 1;
if ($_POST['txtfurtypeid'] == '')
{
$editid = '<font style="color:red;">Please Fill ID</font>';
$editflag = false;
}
else
{
$editid = $_POST['txtfurtypeid'];
}
if ($_POST['txtfurtypename'] == '')
{
$editname = '<font style="color:red;">Please Fill Name</font>';
$editflag = false;
}
else
{
$editname = $_POST['txtfurtypename'];
}
if ($editflag == true)
{
$query = "UPDATE furnituretype SET Typename='$editname' where  FurnitureTypeID='$editid'";
mysqli_query($con, $query);
$success = "Dear " . $editname . " Successfully Update";
echo '<script type="text/javascript">alert("' . $success . '");</script>';
$seeall = 1;
}
else
{
}
}
if (isset($_REQUEST['eid']))
{
$formtype = 1;
$editid = $_REQUEST['eid'];
$selectquery = "SELECT * FROM furnituretype where FurnitureTypeID='$editid'";
$result = mysqli_query($con, $selectquery);
while ($data = mysqli_fetch_array($result))
{
$eid = $data[0];
$ename = $data[1];
}
}
if (isset($_REQUEST['eid']) || $editflag == false)
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" class="css">
    <link rel="stylesheet" href="js/bootstrap.js" class="cs">
    <link rel="stylesheet" href="css/formstyle.css" class="css">
    <title>Furniture Type Update Form
    </title>
  </head>
  <body>
    <form action="furnituretype.php" method="post">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <a href="furnituretype.php">
              <button type="button" class="btn btn-primary btn">New Furniture
              </button>
            </a>
            <a href="furnituretype.php?seeall=1">
              <button type="button" class="btn btn-primary btn">See All Furnitures
              </button>
            </a>
          </div>
        </div>
        <br>
        <div clas="row">
          <?php echo $alreadyexist ?>
        </div>
        <div class="row">
          <div class="col-lg-4"> 
          </div>
          <div class="col-lg-4">
            <div id="ui">
              <h1 class="text-center">Furniture Type
              </h1>
              <form class="form-group text-center">
                <label>Furniture Type ID:
                </label>
                <input type="text" name="txtfurtypeid" class="form-control" readonly="true" value="<?php echo $eid ?>">
                <br>
                <label>Furniture Name:
                </label>
                <input type="text" name="txtfurtypename" class="form-control" value="<?php echo $ename ?>">
                <?php echo $editname; ?>
                <br>
                <div class="row text-center">
                  <input   type="submit" name="edit" value="Update" class="btn btn-primary btn-block btn-lg">
                </div>
                </div>
            </div>
          </div>
        </div>
        </form>
      </body>
    </html>
  <?php
}
?>
  <?php
//----------------------------------------------------------------See All Furniture Table------------------------------------------------------------------------------------
if (isset($_REQUEST['seeall']) || $seeall == 1)
{
$formtype = 1;
?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Furniture Type Table
      </title>
      <link rel="stylesheet" href="css/bootstrap.css" class="css">
      <link rel="stylesheet" href="css/formstyle.css" class="css">
    </head>
    <body>
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <a href="furnituretype.php">
              <button type="button" class="btn btn-primary btn">New Furniture
              </button>
            </a>
            <a href="furnituretype.php?seeall=1">
              <button type="button" class="btn btn-primary btn">See All Furnitures
              </button>
            </a>
          </div>
        </div>
        <br>
        <div class="row text-center">
          <div class="col">
            <table style="width:1000px; height:500px; overflow-y:auto;background-color:white;" class="table table-hover">
              <tbody>
                <tr>
                  <th scope="col"> ID:
                  </th>
                  <th scope="col">Name
                  </th>
                  <th scope="col">Update
                  </th>
                  <th scope="col">Delete
                  </th>
                </tr>
                <?php
$query = "SELECT * FROM furnituretype";
$result = mysqli_query($con, $query);
while ($data = mysqli_fetch_array($result))
{
echo "<tr><td scope='row'>" . $data[0] . "</td><td scope='row'>" . $data[1] . "</td><td scope='row'><a href='furnituretype.php?eid=" . $data[0] . "'>Update</a></td><td scope='row'><a href='furnituretype.php?did=" . $data[0] . "' ><font style='color:red;'>Delete</font></td></tr>";
}
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </body>
  </html>
  <?php
} ?>
  <?php
//-------------------------------------------------------------Save New Furniture---------------------------------------------------------------------------
if ($formtype == 0)
{
if (isset($_POST["furtypesubmit"]))
{
if ($_POST["txtfurtypeid"] == "")
{
$id = "<font style='color:red;'>Please Fill ID ..</font>";
$flag = false;
}
else
{
$id = $_POST["txtfurtypeid"];
}
if ($_POST["txtfurtypename"] == "")
{
$name = "<font style='color:red;'>Please Fill Name ..</font>";
$flag = false;
}
else
{
$name = $_POST["txtfurtypename"];
}
if ($flag == true)
{
$selectall = "SELECT * FROM furnituretype";
$result = mysqli_query($con, $selectall);
while ($data = mysqli_fetch_array($result))
{
if ($id == $data[0])
{
$flag = false;
$alreadyexist = "<center><h2 class='alreadyexist' style='color:red;'>ID Is Already Exist</h2></center>";
}
}
if ($flag == true)
{
$con = mysqli_connect("localhost", "root", "", "furniture");
$query = "INSERT INTO furnituretype VALUES ('$id','$name')";
mysqli_query($con, $query);
$success = "Furniture Type " . $name . " Successfully Registered";
echo '<script type="text/javascript">alert("' . $success . '");</script>';
}
}
}
?>
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="css/bootstrap.css" class="css">
      <link rel="stylesheet" href="js/bootstrap.js" class="cs">
      <link rel="stylesheet" href="css/formstyle.css" class="css">
      <title>Furniture Registration Form
      </title>
    </head>
    <body>
      <form action="furnituretype.php" method="post">
        <div class="container">
          <div class="row text-center">
            <div class="col-md-12">
              <a href="furnituretype.php">
                <button type="button" class="btn btn-primary btn">New Furniture
                </button>
              </a>
              <a href="furnituretype.php?seeall=1">
                <button type="button" class="btn btn-primary btn">See All Furnitures
                </button>
              </a>
            </div>
          </div>
          <br>
          <div clas="row">
            <?php echo $alreadyexist ?>
          </div>
          <div class="row">
            <div class="col-lg-4"> 
            </div>
            <div class="col-lg-4">
              <div id="ui">
                <h1 class="text-center">Furniture Type
                </h1>
                <form class="form-group text-center">
                  <label>Furniture Type:
                  </label>
                  <input type="text" name="txtfurtypeid" class="form-control" placeholder="Enter furniture type ID ..." value="<?php echo $id;?>" readonly="true">
                  <?php echo $id; ?>
                  <br>
                  <label>Furniture Name:
                  </label>
                  <input type="text" name="txtfurtypename" class="form-control" placeholder="Enter furniture type name...">
                  <?php echo $name; ?>
                  <br>
                  <div class="row text-center">
                    <input   type="submit" name="furtypesubmit" value="Save" class="btn btn-primary btn-block btn-lg">
                  </div>
                  </div>
              </div>
            </div>
          </div>
          </form>
        </body>
      </html>
    <?php
} ?>
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
    </html>
