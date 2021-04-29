<?php $con = mysqli_connect("localhost", "root", "", "furniture");
session_start();
if(isset($_REQUEST['destroy'])){
unset($_SESSION['user']);
session_destroy();
unset($_SESSION['logout']);
session_destroy();
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer See All Form
    </title>
    <link rel="stylesheet" href="css/bootstrap.css" class="css">
    <link rel="stylesheet" href="css/formstyle.css" class="css">
  </head>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#myCarousel").on("slide.bs.carousel", function(e) {
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 3;
        var totalItems = $(".carousel-item").length;
        if (idx >= totalItems - (itemsPerSlide - 1)) {
          var it = itemsPerSlide - (totalItems - idx);
          for (var i = 0; i < it; i++) {
            // append slides to end
            if (e.direction == "left") {
              $(".carousel-item")
                .eq(i)
                .appendTo(".carousel-inner");
            }
            else {
              $(".carousel-item")
                .eq(0)
                .appendTo($(this).find(".carousel-inner"));
            }
          }
        }
      }
                         );
    }
                     );
  </script>
  <body >
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
    <div class="container">
      <br>
      <div class="row text-center">
        <div class="col-md-12">
          <h1 class="h1member">All Customers
          </h1>
        </div>
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
              <th scope="col"> Address
              </th>
              <th scope="col"> Phone
              </th>
              <th scope="col">Gender
              </th>
              <th scope="col"> Email
              </th>
              <th scope="col">Birthday
              </th>
              <th scope="col"> Username
              </th>
              <th scope="col"> Password
              </th>
              <th scope="col">Delete
              </th>
            </tr>
            <?php
$query = "SELECT * FROM customer";
$result = mysqli_query($con, $query);
while ($data = mysqli_fetch_array($result))
{
echo "<tr><td scope='row'>" . $data[0] . "</td><td scope='row'>" . $data[1] . "</td><td scope='row'>" . $data[2] . "</td><td scope='row'>" . $data[3] . "</td><td scope='row'>" . $data[4] . "</td>
<td scope='row'>" . $data[5] . "</td><td scope='row'>" . $data[6] . "</td><td scope='row'>" . $data[7] . "</td><td scope='row'>" . $data[8] . "</td><td scope='row'><a href='customer.php?did=" . $data[0] . "' ><font style='color:red;'>Delete</font></td></tr>";
}
?>
          </tbody>
        </table>
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
  <script type="text/javascript" src="js/jquery.js">
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
