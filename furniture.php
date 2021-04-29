<?php 
session_start();
if(isset($_REQUEST['destroy'])){
unset($_SESSION['admin']);
unset($_SESSION['logout']);
}?>
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
    <?php
$con = mysqli_connect("localhost", "root", "", "furniture");
$formtype = 0;
$id='';$ftypeid=''; $furname=''; $qty='';  $size=''; $price ='';$description=''; $image='';$destination='';
$eid='';$eftypeid=''; $efurname=''; $eqty='';  $esize=''; $eprice ='';$edescription=''; $eimage='';$editdestination='';
$editid='';$editftypeid=''; $editfurname=''; $editqty='';  $editsize=''; $editprice ='';$editdescription=''; $editimage='';
$flag = true;
$alreadyexist = '';
$editflag = true;
$seeall = 0;$photo="";
$deleteid='';
//-----------------------------------------------------------------------------------Auto ID Test--------------------------------------------------------------------------------------
include "autoid.php";
$autoid=autoID("furniture","FurnitureID","FU_",10,"FU_0000000001");
if(isset($_REQUEST['did'])){
$deleteid=$_REQUEST['did'];
$query="DELETE from furniture where FurnitureID='$deleteid'";
mysqli_query($con,$query);
}
//--------------------------------------------------------------------------------Update---------------------------------------------------------------------------------------------
if (isset($_REQUEST['edit']))
{     
$autoid='';
if($_FILES['image']['name']!=''){
$editimage=$_FILES['image']['name'];
$editdestination="data/".$editimage;
copy($_FILES["image"]["tmp_name"],$editdestination);
}
else{
$editimage = '<font style="color:red;">Please Choose The Image</font>';
$editflag = false;
}
if ($_REQUEST['txtfurid'] == '')
{
$editid = '<font style="color:red;">Please Fill ID</font>';
$editflag = false;
}
else
{
$editid = $_REQUEST['txtfurid'];
} 
if ($_REQUEST['txtfurtypeid'] == '')
{
$editftypeid = '<font style="color:red;">Please Fill Furniture Type ID</font>';
$editflag = false;
}
else
{
$editftypeid = $_REQUEST['txtfurtypeid'];
}
if ($_REQUEST['txtfurname'] == '')
{
$editfurname = '<font style="color:red;">Please Fill Furniture Name</font>';
$editflag = false;
}
else
{
$editfurname =$_REQUEST['txtfurname'];
}
if ($_REQUEST['txtqty'] == '')
{
$editqty = '<font style="color:red;">Please Fill Quantity</font>';
$editflag = false;
}
else
{
$editqty =$_REQUEST['txtqty'];
}
if ($_REQUEST['txtsize'] == '')
{
$editsize = '<font style="color:red;">Please Fill Size</font>';
$editflag = false;
}
else
{
$editsize = $_REQUEST['txtsize'];
}
if ($_REQUEST['txtprice'] == '')
{
$editprice = '<font style="color:red;">Please Fill Price</font>';
$editflag = false;
}
else
{
$editprice =$_REQUEST['txtprice'];
}
if ($_REQUEST['txtdescription'] == '')
{
$editdescription = '<font style="color:red;">Please Fill Furniture Description</font>';
$editflag = false;
}
else
{
$editdescription = $_REQUEST['txtdescription'];
}
if ($editflag == true)
{
$query = "UPDATE furniture set FurnitureName='$editfurname',FurnitureTypeID='$editftypeid',Price='$editprice',size='$editsize',quantity='$editqty',description='$editdescription',image='$editdestination' where FurnitureID='$editid'";
mysqli_query($con, $query);
$success = "Dear " . $editfurname . " Successfully Update";
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
$autoid='';
$editid = $_REQUEST['eid'];
$selectquery = "SELECT * FROM furniture where FurnitureID='$editid'";
$result = mysqli_query($con, $selectquery);
while ($data = mysqli_fetch_array($result))
{
$eid = $data[0];
$efurname = $data[1];
$eftypeid = $data[2];
$eprice = $data[3];
$esize = $data[4];
$eqty = $data[5];
$edescription = $data[6];
$eimage= $data[7];
}
}
?>
    <?php 
//-------------------------------------------------------------------------New Customer Save Form-----------------------------------------------------------------------------------------
if (isset($_REQUEST['save']))
{      if($_FILES['image']['name']!=''){
$image=$_FILES['image']['name'];
$destination="data/".$image;
copy($_FILES["image"]["tmp_name"],$destination);
}
else{
$image = '<font style="color:red;">Please Choose The Image</font>';
$flag = false;
}
if ($_REQUEST['txtfurid'] == '')
{
$id = '<font style="color:red;">Please Fill ID</font>';
$flag = false;
}
else
{
$id = $_REQUEST['txtfurid'];
} 
if ($_REQUEST['txtfurtypeid'] == '')
{
$ftypeid = '<font style="color:red;">Please Fill Furniture Type ID</font>';
$flag = false;
}
else
{
$ftypeid = $_REQUEST['txtfurtypeid'];
}
if ($_REQUEST['txtfurname'] == '')
{
$furname = '<font style="color:red;">Please Fill Furniture Name</font>';
$flag = false;
}
else
{
$furname =$_REQUEST['txtfurname'];
}
if ($_REQUEST['txtqty'] == '')
{
$qty = '<font style="color:red;">Please Fill Quantity</font>';
$flag = false;
}
else
{
$qty =$_REQUEST['txtqty'];
}
if ($_REQUEST['txtsize'] == '')
{
$size = '<font style="color:red;">Please Fill Size</font>';
$flag = false;
}
else
{
$size = $_REQUEST['txtsize'];
}
if ($_REQUEST['txtprice'] == '')
{
$price = '<font style="color:red;">Please Fill Price</font>';
$flag = false;
}
else
{
$price =$_REQUEST['txtprice'];
}
if ($_REQUEST['txtdescription'] == '')
{
$description = '<font style="color:red;">Please Fill Furniture Description</font>';
$flag = false;
}
else
{
$description = $_REQUEST['txtdescription'];
}
if ($flag == true)
{
if ($flag == true)
{
$sql = "INSERT INTO furniture VALUES ('$id','$furname','$ftypeid','$price','$size','$qty','$description','$destination')";
mysqli_query($con, $sql);
$success = "Dear " . $furname . " Successfully Registered";
echo '<script type="text/javascript">alert("' . $success . '");</script>';
$id='';$ftypeid=''; $furname=''; $qty='';  $size=''; $price ='';$description=''; $destination='';
}
if ($flag == false)
{
$alreadyexist = "<center><h2 class='alreadyexist' style='color:red;'> Already Exist</h2></center>";
}
}
}
?>
    <div class="container ">
      <div class="row">
      </div>
      <form action="furniture.php" method="post" enctype="multipart/form-data">
        <div class="row ">
          <div class="col-lg-2"> 
          </div>
          <div class="col-lg-8">
            <div id="ui">
              <h1 class="text-center">Furniture
              </h1>
              <form class="form-group text-center">
                <div class="row">
                  <div class="col-lg-6">
                    <label>Furniture ID:
                    </label>
                    <input type="text" name="txtfurid" class="form-control"
                           value="<?php echo $autoid; echo $editid;?>" readonly="true">
                    <?php echo$id;  ?>
                  </div>
                  <div class="col-lg-6">    
                    <label>Furniture Type ID:
                    </label> 
                    <select name="txtfurtypeid" class="form-control" >
                      <?php 
$query="select * from furnituretype";
$result=mysqli_query($con,$query);
while($data=mysqli_fetch_array($result)){
?>
                      <option>
                        <?php echo $data[0];?>
                      </option>
                      <?php }?>
                      <option selected>
                        <?php echo $eftypeid; ?>
                      </option>
                    </select>
                    <?php echo $ftypeid;echo $editftypeid;?>
                  </div>
                </div>
                <br>
                <label>Furniture Name:
                </label>
                <input type="text" name="txtfurname" class="form-control" value="<?php echo $efurname ?>">
                <?php echo $furname;$editfurname; ?>
                <br>
                <div class="row">
                  <div class="col-lg-6">
                    <label>Quantity:
                    </label>
                    <input type="text" name="txtqty" class="form-control"
                           value="<?php echo $eqty ?>">
                    <?php echo $editqty;echo $qty; ?>
                  </div>
                  <div class="col-lg-6">
                    <label>Size:
                    </label>
                    <input type="tel" name="txtsize" class="form-control" name="txtsize"
                           value="<?php echo $esize; ?>">
                    <?php echo $editsize;echo $size; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <br>
                    <br>
                    <label>Price
                    </label>
                    <input type="text" name="txtprice" class="form-control"
                           value="<?php echo $eprice; ?>">
                    <?php echo $editprice;echo $price; ?>
                  </div>
                  <br>
                  <div class="col-lg-6">
                    <label>Description:
                    </label>
                    <textarea name="txtdescription" class="form-control"
                              rows="5">
                      <?php echo $edescription; ?>
                    </textarea>
                    <?php echo $editdescription;echo $description; ?>
                  </div>
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload
                    </span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                           name='image' aria-describedby="inputGroupFileAddon01" required>
                    <label class="custom-file-label" for="inputGroupFile01">Choose file
                    </label>
                  </div>
                </div>
                <div class="row text-center" style="padding-left:90px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  
                  <div class="col-lg-3">
                    <div class="row text-center" > 
                      <input type="submit" name="save" value=" Save "
                             class="btn btn-primary btn-block btn-lg"> 
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <a href="furniture.php">
                      <div class="row text-center"> 
                        <input type="submit" name="edit" value="Update"
                               class="btn btn-primary btn-block btn-lg">
                        </a> 
                      </div>
                  </div>
                  <br>
                  <br>
                </div>
              </form>                  
              <br>
            </div>
          </div>
        </div>
        </div>
    </div>
    </form>
  </div>
<br>
<br>
<div class="container" style="margin-left:500px;">
  <div class="row text-center">
  </div>
  <div class="row text-center">
    <table style="width:900px; height:500px; overflow-y:auto;background-color:white;"
           class="table table-hover white">
      <tbody>
        <tr>
          <th scope="col"> ID:
          </th>
          <th scope="col">Name
          </th>
          <th scope="col"> Type ID
          </th>
          <th scope="col">Price
          </th>
          <th scope="col">Size
          </th>
          <th scope="col"> Quantity
          </th>
          <th scope="col"> Description
          </th>
          <th scope="col"> Image
          </th>
          <th scope="col">Update
          </th>
          <th scope="col">Delete
          </th>
        </tr>
        <?php
$query = "SELECT * FROM furniture";
$result = mysqli_query($con, $query);
while ($data = mysqli_fetch_array($result))
{
$photo= '<img src="'.$data[7].'"width="100" height="100"/>';
echo "<tr><td scope='row'>" . $data[0] . "</td><td scope='row'>" . $data[1] . "</td><td scope='row'>" . $data[2] . "</td><td scope='row'>" . $data[3] . "</td><td scope='row'>" . $data[4] . "</td>
<td scope='row'>" . $data[5] . "</td><td scope='row'>" . $data[6] . "</td><td scope='row'>" . $photo . "</td><td scope='row'><a href='furniture.php?eid=" . $data[0] . "'>Update</a></td><td scope='row'><a href='furniture.php?did=" . $data[0] . "' ><font style='color:red;'>Delete</font></a></td></tr>";
}
?>
      </tbody>
    </table>
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
</html>
