<?php include('database.php'); ?>


<?php if (isset($_POST['submit'])) {
  $sname = $_POST['cname'];

  $sqlquery = "INSERT INTO countries(Countryname) VALUES ('$sname')";
  // print_r($sqlquery);exit;
  $inserted = ($conn->query($sqlquery));
  //print_r($conn);exit;
  if ($inserted) {
    header('location:form2.php');
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
    .card {
      background-color: azure;
    }
  </style>
</head>

<body>


  <div class="container">
    <h2 style=text-align:center;>Country form</h2>
    <form class="form-horizontal" action="" method="post">

      <div class="card mt-5">

        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Country name:</label>
          <div class="col-sm-3">
            <input type="text" name="cname" class="form-control" placeholder="Enter country">
          </div>
        </div>


        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <!-- <input type="submit" name="submit"> -->
            <button type="submit" class="btn btn-default" name="submit">Submit</button>
          </div>
        </div>

      </div>
  </div>
  </form>


</body>

</html>