<?php
include('database.php');

    $id=$_POST['state_id']; 
//    print_r($id);exit;
 
 

$result = mysqli_query($conn,"SELECT * FROM cities where state_id = $id");
//  print_r($result);exit;
?>


<option value="">Select city</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["cityname"];?></option>
<?php
}
?>