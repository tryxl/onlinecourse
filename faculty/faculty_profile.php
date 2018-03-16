<?php
session_start();
include('../includes/config.php');
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
if(strlen($_SESSION['email'])==0)
{
  header("Location:http://$host$uri/index.php");
}
else
{
  if(isset($_POST['submit']))
  {
    $studentname=$_POST['studentname'];
    $studentemail=$_POST['studentemail'];
    $studentphone=$_POST['studentphone'];
    $studentdob=$_POST['studentdob'];
    $studentstreet1=$_POST['studentstreet1'];
    $studentstreet2=$_POST['studentstreet2'];
    $studentcity=$_POST['studentcity'];
    $studentstate=$_POST['studentstate'];
    $studentpincode=$_POST['studentpincode'];
    // $photo=$_FILES["photo"]["name"];
    $cgpa=$_POST['cgpa'];
    // move_uploaded_file($_FILES["photo"]["tmp_name"],"studentphoto/".$_FILES["photo"]["name"]);
    $ret=mysqli_query($con,"UPDATE userstable SET UserName='$studentname',
                                                  UserEmail='$studentemail',
                                                  UserPhone='$studentphone',
                                                  UserDOB='$studentdob',
                                                  UserStreet1='$studentstreet1',
                                                  UserStreet2='$studentstreet2',
                                                  UserCity='$studentcity',
                                                  UserState='$studentstate' WHERE UserId='".$_SESSION['id']."'");
    if($ret)
      $_SESSION['msg']="Profile Updated Successfully!";
    else
      $_SESSION['msg']="Error : Your Profile could not be updated";
    header("Location:http://$host$uri/faculty_profile.php");
    exit();
  }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Profile</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('../includes/header.php');
if($_SESSION['email']!="")
  include('../includes/menubar.php');
?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">My Profile</h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div class="panel panel-default">
                          <font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>
                          <?php $sql=mysqli_query($con, "SELECT * FROM studenttable WHERE StudentId='".$_SESSION['userid']."'");
                          $cnt=1;
                          while($row=mysqli_fetch_array($sql))
                          {
                          ?>
                            <div class="panel-body">
                            <form name="dept" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="studentid">Faculty ID   </label>
                                <input type="text" class="form-control" id="studentid" name="studentid" value="<?php echo htmlentities($row['StudentId']);?>"  placeholder="Student Reg no" readonly />
                              </div>

                              <div class="form-group">
                                <label for="studentname">Name  </label>
                                <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['StudentName']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentemail">Email  </label>
                                <input type="text" class="form-control" id="studentemail" name="studentemail" value="<?php echo htmlentities($row['StudentEmail']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentphone">Phone number  </label>
                                <input type="text" class="form-control" id="studentphone" name="studentphone" value="<?php echo htmlentities($row['StudentPhone']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentdob">Date of Birth </label>
                                <input type="date" class="form-control" id="studentdob" name="studentdob" value="<?php echo htmlentities($row['StudentDOB']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentstreet1">Address Street 1  </label>
                                <input type="text" class="form-control" id="studentstreet1" name="studentstreet1" value="<?php echo htmlentities($row['StudentStreet1']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentstreet2">Address Street 2  </label>
                                <input type="text" class="form-control" id="studentstreet2" name="studentstreet2" value="<?php echo htmlentities($row['StudentStreet2']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentcity">City  </label>
                                <input type="text" class="form-control" id="studentcity" name="studentcity" value="<?php echo htmlentities($row['StudentCity']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentstate">State  </label>
                                <input type="text" class="form-control" id="studentstate" name="studentstate" value="<?php echo htmlentities($row['StudentState']);?>"  />
                              </div>

                              <div class="form-group">
                                <label for="studentpincode">Pincode  </label>
                                <input type="text" class="form-control" id="studentpincode" name="studentpincode" value="<?php echo htmlentities($row['StudentPinCode']);?>" required />
                              </div>

                              <!-- <div class="form-group">
                                <label for="Pincode">Student Photo  </label>
                               <?php if($row['studentPhoto']==""){ ?>
                               <img src="studentphoto/noimage.png" width="200" height="200"><?php } else {?>
                               <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']);?>" width="200" height="200">
                               <?php } ?>
                              </div>

                              <div class="form-group">
                                <label for="Pincode">Upload New Photo  </label>
                                <input type="file" class="form-control" id="photo" name="photo"  value="<?php echo htmlentities($row['studentPhoto']);?>" />
                              </div> -->

                          <?php } ?>

                             <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>

</body>
</html>
<?php } ?>
