<?php include('database.php'); ?>
<?php if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  // print_r($name);exit;

  $email = $_POST['email'];


  // $pwd = $_POST['password'];

  $password = $_POST['password'];
  $encrypted_pwd = md5($password);

  $countryname = $_POST['countryname'];

  $statename = $_POST['statename'];

  $cityname = $_POST['cityname'];






  $fileName = $_FILES['the_file']['name'];

  // print_r($_FILES);
  // exit;
  $fileSize = $_FILES['the_file']['size'];
  // print_r($fileSize);
  $fileTmpName  = $_FILES['the_file']['tmp_name'];
  //  print_r($fileTmpName);exit;
  $fileType = $_FILES['the_file']['type'];

  $file_store = "images/" . $fileName;



  if (move_uploaded_file($$fileTmpName, $file_store)) {
    echo "file upload successfully";
  } else {
    "file not upload";
  }






  $sqlquery = "INSERT INTO users(name,email,password,country_id,state_id,city_id,image) VALUES ('$name','$email','$encrypted_pwd','$countryname','$statename','$cityname','$file_store')";

  $inserted = ($conn->query($sqlquery));
  // print_r($conn);exit;
  if ($inserted) {
    //    header('location:state-cityform.php');
    echo "data inserted successfully";
  } else {
    echo "data not inserted";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    .card {
      background-color: azure;
    }
  </style>
</head>

<body>


  <div class="container">
    <h2 style=text-align:center;>Registration form</h2>

    <form action="" method="post" enctype="multipart/form-data">
      <div class="card mt-5">

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="inputname" name="name" placeholder="Your name">
          </div>
        </div>


        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-5">
            <input type="email" class="form-control" id="inputEmail" name="email" placeholder=" Your Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-5">
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder=" Your Password">
          </div>
        </div>




        <div class="form-group row">
          <label class="col-sm-2 col-form-label">CountryName</label>
          <div class="col-sm-5">

            <select class="form-control" id="country-dropdown" name="countryname">
              <option disabled selected>Please Select Country</option>
              <?php
              $sql = "SELECT * FROM countries";

              $result = $conn->query($sql);
              while ($row = mysqli_fetch_array($result)) {
              ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row["countryname"]; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>




        <div class="form-group row">
          <label class="col-sm-2 col-form-label">StateName</label>
          <div class="col-sm-5">
            <select class="form-control" id="state-dropdown" name="statename">
              <option disabled selected>Please Select Statename</option>
            </select>
          </div>
        </div>




        <div class="form-group row">
          <label class="col-sm-2 col-form-label">CityName</label>
          <div class="col-sm-5">
            <select class="form-control" id="city-dropdown" name="cityname">
              <option disabled selected>Please Select Cityname</option>
            </select>
          </div>
        </div>


        <div class="form-group row">
          <label class="col-sm-2 col-form-label"><b>Upload File</b> </label>
          <div class="col-sm-5">
            
             
          
                <input type="file" class="form-control-file" name="the_file" id="fileToUpload">
              </div>
            </div>

          </div>
        </div>





        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="submit">
            <a href="login.php">Go to login</a>


          </div>
        </div>

      </div>
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