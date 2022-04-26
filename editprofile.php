<?php include('database.php');
?>

<?php
session_start();
if (empty($_SESSION['sess_user'])) {
  header('location:login.php');
}
?>
<?php
$sql = "SELECT * FROM users WHERE id='" . $_SESSION['id'] . "'";

// $countryquery = "SELECT * FROM users"; 

// print_r($sql);

$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {

  $name = $row['name'];
  // print_r($name);

  $email = $row['email'];
  // print_r($email);


  $password = $row['password'];
  $encrypted_pwd = md5($password);
  // print_r($encrypted_pwd);
  $countryname = $row['countryname'];

  $statename = $row['statename'];

  $cityname = $row['cityname'];
}
$sqlquery = "SELECT * FROM countries WHERE id='" . $_SESSION['id'] . "'";
$results = $conn->query($sqlquery);


$statesql = "SELECT * FROM states WHERE id='" . $_SESSION['id'] . "'";
$res = $conn->query($statesql);

$citiessql = "SELECT * FROM cities WHERE id='" . $_SESSION['id'] . "'";
$cityresult = $conn->query($citiessql);


?>
<!DOCTYPE html>
<html>

<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    /* .card{
      background-color:azure;
    } */
  </style>
</head>

<body>


  <div class="container">
    <h2 style=text-align:center;>Registration form</h2>

    <form action="" method="post">
      <!-- <div class="card mt-5"> -->

      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" id="inputname" name="name" placeholder="Your name" value=<?php echo $name; ?>>
        </div>
      </div>


      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-5">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder=" Your Email" value=<?php echo $email; ?>>
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-5">
          <input type="password" class="form-control" id="inputPassword" name="password" placeholder=" Your Password" value=<?php echo $password; ?>>
        </div>
      </div>




      <div class="form-group row">
        <label class="col-sm-2 col-form-label">CountryName</label>
        <div class="col-sm-5">

          <select class="form-control" id="country-dropdown" name="countryname">

            <?php
            while ($rows = mysqli_fetch_array($results)) {
              echo '<option value="' . $rows['id'] . '">' . $rows['countryname'] . '</option>';
            }
            ?>

          </select>
        </div>
      </div>




      <div class="form-group row">
        <label class="col-sm-2 col-form-label">StateName</label>
        <div class="col-sm-5">
          <select class="form-control" id="state-dropdown" name="statename">


            <?php


            while ($data = mysqli_fetch_array($res)) {
              echo '<option value="' . $data['id'] . '">' . $data['statename'] . '</option>';
            }
            ?>

          </select>
        </div>
      </div>




      <div class="form-group row">
        <label class="col-sm-2 col-form-label">CityName</label>
        <div class="col-sm-5">
          <select class="form-control" id="city-dropdown" name="cityname">
            <?php



            while ($datas = mysqli_fetch_array($cityresult)) {
              echo '<option value="' . $datas['id'] . '">' . $datas['cityname'] . '</option>';
            }
            ?>
          </select>
        </div>
      </div>








      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" name="submit">
          <a href="loginpage.php">Go to login</a>


        </div>
      </div>

      <!-- </div> -->
  </div>
  </div>
  </div>
  </form>
</body>

</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    // alert('test');
    $('#country-dropdown').on('change', function() {
      // alert('dfs');
      var country_id = this.value;
      // console.log(country_id);
      // return false;
      $.ajax({
        url: "statecountry.php",
        type: "POST",
        data: {
          country_id: country_id
        },


        success: function(result) {
          $("#state-dropdown").html(result);
          //    alert('success');
        }
      });


    });
  });
</script>

<script>
  $(document).ready(function() {
    // alert('test');
    $('#state-dropdown').on('change', function() {
      // alert('dfs');
      var state_id = this.value;
      // console.log(country_id);
      // return false;
      $.ajax({
        url: "statecity.php",
        type: "POST",
        data: {
          state_id: state_id
        },


        success: function(result) {
          $("#city-dropdown").html(result);
          //    alert('success');
        }
      });


    });
  });
</script>


<?php include('footer.php');
?>