<?php include('database.php');

?>

<?php if (isset($_POST['submit'])){

    $sname=$_POST['sname'];
  
    $country_id=$_POST['countryname'];
    
    $sqlquery = "INSERT INTO states(country_id,statename) VALUES ('$country_id','$sname')";
   
      $inserted = ($conn->query($sqlquery));
      // print_r($conn);exit;
        if ($inserted) {
           header('location:state-cityform.php');
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
  <!-- <div class="card mt-5"> -->
   

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
    <label  class="col-sm-2 col-form-label">StateName</label>
   <div class="col-sm-5">
   <input type="text" name="sname" class="form-control"  placeholder="Enter statename"><br>
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