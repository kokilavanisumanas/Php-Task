<?php include('database.php'); ?>

<?php if (isset($_POST['submit'])){



  $country_id=$_POST['countryname'];
  print_r($country_id);
  $state_id=$_POST['statename'];
print_r('state_id');
    $cityname=$_POST['cityname'];
  
   
    
    $sqlquery = "INSERT INTO cities(state_id,cityname,country_id) VALUES ('$state_id','$cityname','$country_id')";
   
      $inserted = ($conn->query($sqlquery));
      // print_r($conn);exit;
        if ($inserted) {
          header('location:ajaxform.php');
             echo "data inserted successfully";
            
            } else { 
                echo "data not inserted";
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <style>
    .card{
      background-color:azure;
    }
    </style>
</head>
<body>

<div class="container">
<h2 style=text-align:center;>Country form</h2>
  <form action="" method="post">
  <div class="card mt-5">
   


  
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">CountryName</label>
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
        <label class="col-sm-2 col-form-label">State Name:</label>
        <div class="col-sm-5">
        <select class="form-control" id="state-dropdown"  name="statename">
        <option disabled selected>Please Select Your State</option>
        </select>
    </div>
          </div>
   


   
   
    <div class="form-group row">
   <label class="col-sm-2 col-form-label" for="email">City name:</label>
   <div class="col-sm-5">

   <input type="text" name="cityname" class="form-control"  placeholder="Enter city"><br>
   </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="submit" name="submit">
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
          
             
                success: function(result){
                    $("#state-dropdown").html(result);
                  //  alert('success');
                }
            });
        
        
    }); 
});
    </script>  