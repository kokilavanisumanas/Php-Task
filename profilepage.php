<?php

include('database.php');
session_start();
$sqlquery = "SELECT * FROM users";
$countryquery = "SELECT * FROM countries"; 
$country_result = $conn->query($countryquery);
                                 
                                
                        
// echo $country_result;exit;
$result = $conn->query($sqlquery);
$row = $result->fetch_assoc();
$username = $row['username'];
$password = $row['password_user'];
// echo $password;exit;
$sesid=$_SESSION['id'];
// $img=$row['images'];`
// print_r($t);


?>
<link href="./css/editprofile.css" rel="stylesheet" id="style">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                 <h5> </h5>
                                   <?php //$row["id"];?>
                                    </h5>
                                    <h6>
                                     <?php $row["country_id"] ?>   
                                    </h6>
                                    <!-- <p class="proile-rating">RANKINGS : <span>8/10</span></p> -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    <a href="changepassword.php" class='btn btn-primary'>Change Password</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <!-- <a href="editprofile.php"> <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/></a> -->
                  <a href="editprofile.php">edit</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                     
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                              
                                            </div>
                                            <div class="col-md-6">
                                           <p> <?php  echo "<td>".$row["id"]."</td>";?></p>
                                              
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php  echo "<td>".$row["name"]."</td>";?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php  echo "<td>".$row["email"]."</td>";?></p>
                                            </div>
                                        </div>
                                      
                                       
                            </div>
                         
                        </div>
                    </div>
                </div>
            </form>           
        </div>

        <?php //}?>