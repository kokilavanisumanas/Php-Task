<?php
include('database.php');

    $id=$_POST['country_id']; 
//    print_r($id);exit;
 
 

$result = mysqli_query($conn,"SELECT * FROM states where country_id = $id");
//  print_r($result);exit;
?>


<option value="">Select State</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["id"];?>"><?php echo $row["statename"];?></option>
<?php
}
?>