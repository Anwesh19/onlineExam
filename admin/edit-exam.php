<?php 
include 'includes/check_user.php'; 
include 'includes/check_reply.php';
if (isset($_GET['eid'])) {
include '../database/config.php';
$exam_id = mysqli_real_escape_string($conn, $_GET['eid']);
$sql = "SELECT * FROM tbl_examinations WHERE exam_id = '$exam_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
     $excate = $row['category'];
	 $exsubject = $row['subject'];
	 $exname = $row['exam_name'];
	 $exdate = $row['date'];
	 $exduration = $row['duration'];
     $extotques= $row['tot_ques'];
     $exqueseasy= $row['ques_easy'];
     $exquesmedium= $row['ques_medium'];
     $exqueshard= $row['ques_hard'];
	 $expassmark = $row['passmark'];
	 $exreex = $row['re_exam'];
	 $exterms = $row['terms'];
    }
} else {
    header("location:./");
}
$conn->close();	
}else{
	header("location:./");
}
?>
<!DOCTYPE html>
<html>
   
<head>
        
        <title>OES | Edit Assessment</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Online Examination System" />
        <meta name="keywords" content="Online Examination System" />
        <meta name="author" content="Bwire Charles Mashauri" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>	
        <link href="../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
		<link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/images/icon.png" rel="icon">
        <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/snack.css" rel="stylesheet" type="text/css"/>
        <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>
		

        <link href="../assets/plugins/summernote-master/summernote.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
        
		

        
    </head>
    <body <?php if ($ms == "1") { print 'onload="myFunction()"'; } ?>  class="page-header-fixed">
        <div class="overlay"></div>
        <div class="menu-wrap">
            <nav class="profile-menu">
                <div class="profile">
				<?php 
				if ($myavatar == NULL) {
				print' <img width="60" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
				}else{
				echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" width="60" alt="'.$myfname.'"/>';	
				}
						
				?>
				<span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?></span></div>
                <div class="profile-menu-list">
                    <a href="profile.php"><i class="fa fa-user"></i><span>Profile</span></a>
                    <a href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a>
                </div>
            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>
        <form class="search-form" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control search-input" placeholder="Search student..." required>
                <span class="input-group-btn">
                    <button class="btn btn-default close-search waves-effect waves-button waves-classic" type="button"><i class="fa fa-times"></i></button>
                </span>
            </div>
        </form>
        <main class="page-content content-wrap">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="logo-box">
                        <a href="./" class="logo-text"><span><img src="../assets/images/7hillsTS.png" alt="" height="76" width="130"></span></a>
                    </div>
                    <div class="search-button">
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="topmenu-outer">
                        <div class="top-menu">
                            <ul class="nav navbar-nav navbar-right">
                                <li>	
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                        <span class="user-name"><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><i class="fa fa-angle-down"></i></span>
										<?php 
						                if ($myavatar == NULL) {
						                print' <img class="img-circle avatar"  width="40" height="40" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						                }else{
						                echo '<img width="40" height="40" src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle avatar"  alt="'.$myfname.'"/>';	
						                }
						
						                ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-list" role="menu">
                                        <li role="presentation"><a href="profile.php"><i class="fa fa-user"></i>Profile</a></li>
                                        <li role="presentation"><a href="logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="logout.php" class="log-out waves-effect waves-button waves-classic">
                                        <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                                    </a>
                                </li>
                                <li>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-sidebar sidebar">
                <div class="page-sidebar-inner slimscroll">
                    <div class="sidebar-header">
                        <div class="sidebar-profile">
                            <a href="javascript:void(0);" id="profile-menu-link">
                                <div class="sidebar-profile-image">
								<?php 
						        if ($myavatar == NULL) {
						        print' <img class="img-circle img-responsive" src="../assets/images/'.$mygender.'.png" alt="'.$myfname.'">';
						        }else{
						        echo '<img src="data:image/jpeg;base64,'.base64_encode($myavatar).'" class="img-circle img-responsive"  alt="'.$myfname.'"/>';	
						        }
						
						        ?>
                       
                                </div>
                                <div class="sidebar-profile-details">
                                    <span><?php echo "$myfname"; ?> <?php echo "$mylname"; ?><br><small>OES Administrator</small></span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <ul class="menu accordion-menu">
                    <li><a href="./" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Dashboard</p></a></li>
						<li><a href="departments.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-folder-open"></span><p>Domain</p></a></li>
						<li><a href="categories.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-tags"></span><p>Services</p></a></li>
						<li><a href="subject.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-file"></span><p>Skills</p></a></li>
						<li><a href="students.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon glyphicon-user"></span><p>Candidates</p></a></li>
						<li><a href="examinations.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-book"></span><p>Assessment</p></a></li>
						<li><a href="questions.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-question-sign"></span><p>Questions</p></a></li>
						<li><a href="notice.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th-list"></span><p>bulletin Board</p></a></li>
						<li><a href="results.php" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-certificate"></span><p>Assessment Results</p></a></li>
                    </ul>
                </div>
            </div>
            <div class="page-inner">
                <div class="page-title">
                    <h3>Edit Assessment - <?php echo "$exname"; ?></h3>



                </div>
                <div id="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
						<div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-white">
                                    <div class="panel-body">
                                         <form action="pages/update_exam.php" method="POST">
										<div class="form-group">
                                            <label for="exampleInputEmail1">Assessment Name</label>
                                            <input type="text" class="form-control" value="<?php echo"$exname"; ?>" placeholder="Enter assessment name" name="exam" required autocomplete="off">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Assessment Duration (Minutes)</label>
                                            <input type="number" class="form-control" value="<?php echo"$exduration"; ?>" placeholder="Enter assessment duration" name="duration" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
											<label for="exampleInputEmail1">Total No: of questions</label>
											<input type="number" class="form-control" value="<?php echo"$extotques"; ?>"placeholder="Enter Total questions" name="tot_ques" required autocomplete="off"> </div>
										<div class="form-group">
											<label for="exampleInputEmail1">No: of Easy questions in %</label>
											<input type="number"  min="0" max="100" step="5" id ="easy" class="category form-control" value="<?php echo"$exqueseasy"; ?>"placeholder="Enter number of questions in %" name="ques_easy" required autocomplete="off" onchange="handleChange(this);"> </div>
										<div class="form-group">
											<label for="exampleInputEmail1">No: of Medium questions in %</label>
											<input type="number"  min="0" max="100" step="5" id ="medium"class="category form-control"value="<?php echo"$exquesmedium"; ?>" placeholder="Enter number of questions in %" name="ques_medium" required autocomplete="off" onchange="handleChange(this);"> </div>
										<div class="form-group">
											<label for="exampleInputEmail1">No: of Hard questions in %</label>
											<input type="number" min="0" max="100" step="5"id ="hard" class="category form-control" value="<?php echo"$exqueshard"; ?>"placeholder="Enter number of questions in %" name="ques_hard" required autocomplete="off" onchange="handleChange(this);"> </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Passmark (%)</label>
                                            <input type="number" class="form-control" value="<?php echo"$expassmark"; ?>" placeholder="Enter passmark" name="passmark" required autocomplete="off">
                                        </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">RE exam (if you take exam then show it again after some days)</label>
                                            <input type="number" class="form-control" value="<?php echo"$exreex"; ?>" placeholder="Enter days to attempt" name="attempts" required autocomplete="off">
                                        </div>
									<div class="form-group">
                                    <label >Deadline</label>
                                    <input type="text" class="form-control date-picker" value="<?php echo"$exdate"; ?>" name="date" required autocomplete="off" placeholder="Select deadline">
                                    </div>
										<div class="form-group">
                                            <label for="exampleInputEmail1">Select Subject</label>
                                            <select class="form-control" name="subject" required>
											<option value="" selected disabled>-Select subject</option>
											<?php
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_subjects WHERE status = 'Active' ORDER BY name";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
    
                                            while($row = $result->fetch_assoc()) {
											if ($exsubject == $row['name']) {
											print '<option selected value="'.$row['name'].'">'.$row['name'].'</option>';	
											}else{
											print '<option value="'.$row['name'].'">'.$row['name'].'</option>';	
											}
                                            
                                            }
                                           } else {
                          
                                            }
                                             $conn->close();
											 ?>
											
											</select>
                                        </div>
										
										<div class="form-group">
                                            <label for="exampleInputEmail1">Select Category</label>
                                            <select class="form-control" name="category" required>
											<option value="" selected disabled>-Select category-</option>
											<?php
											include '../database/config.php';
											$sql = "SELECT * FROM tbl_categories WHERE status = 'Active' ORDER BY name";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
    
                                            while($row = $result->fetch_assoc()) {
                                          	if ($excate == $row['name']) {
											print '<option selected value="'.$row['name'].'">'.$row['name'].'</option>';	
											}else{
											print '<option value="'.$row['name'].'">'.$row['name'].'</option>';	
											}
                                            }
                                           } else {
                          
                                            }
                                             $conn->close();
											 ?>
											
											</select>
                                        </div>
									
									
									<div class="form-group">
                                            <label for="exampleInputEmail1">Terms and conditions</label>
                                            <textarea style="resize: none;" rows="6" class="form-control" placeholder="Enter Terms and conditions" name="instructions" required autocomplete="off"><?php echo"$exterms"; ?></textarea>
                                     </div>
									 <input type="hidden" name="examid" value="<?php echo "$exam_id"; ?>">


                                        <button type="submit" class="btn btn-primary">Submit</button>
                                       </form>
                                    </div>
                                </div>  
  
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
                
            </div>
        </main>
		<?php if ($ms == "1") {
?> <div class="alert alert-success" id="snackbar"><?php echo "$description"; ?></div> <?php	
}else{
	
}
?>

        <div class="cd-overlay"></div>

        <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="../assets/plugins/pace-master/pace.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/classie.js"></script>
        <script src="../assets/plugins/offcanvasmenueffects/js/main.js"></script>
        <script src="../assets/plugins/waves/waves.min.js"></script>
        <script src="../assets/plugins/3d-bold-navigation/js/main.js"></script>
        <script src="../assets/plugins/jquery-mockjax-master/jquery.mockjax.js"></script>
        <script src="../assets/plugins/moment/moment.js"></script>
        <script src="../assets/plugins/datatables/js/jquery.datatables.min.js"></script>
        <script src="../assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
        <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../assets/js/modern.min.js"></script>
        <script src="../assets/js/pages/table-data.js"></script>
		<script src="../assets/plugins/select2/js/select2.min.js"></script>
        <script src="../assets/plugins/summernote-master/summernote.min.js"></script>
        <script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="../assets/js/pages/form-elements.js"></script>
		

		<script>

$(document).ready(function(){
					$(".category").bind("change paste ", function() {
						var total=parseInt(0);	
						if ($.trim($("#easy").val()) != "" && $.trim($("#medium").val()) == "" && $.trim($("#hard").val()) == "")
							 {
								total=parseInt($('#easy').val(),10);
								
								if(total < 0 ||total > 100)
								{
							        
						            $(this).val('') ;
								}
							}
							if ($.trim($("#easy").val()) == "" && $.trim($("#medium").val()) != "" && $.trim($("#hard").val()) == "")
							 {
								total=parseInt($('#medium').val(),10);
								
								if(total < 0 ||total > 100)
								{
							        
						            $(this).val('') ;
								}
							}
							if ($.trim($("#easy").val()) == "" && $.trim($("#medium").val()) == "" && $.trim($("#hard").val()) != "")
							 {
								total=parseInt($('#hard').val(),10);
								
								if(total < 0 ||total > 100)
								{
							        
						            $(this).val('') ;
								}
							}
						if ($.trim($("#easy").val()) == "" && $.trim($("#medium").val()) != "" && $.trim($("#hard").val()) != "")
							 {
								total=parseInt($('#medium').val(),10)+parseInt($('#hard').val(),10);
								
								if(total < 0 ||total > 100)
								{
							        
						            $(this).val('') ;
								}
							}
						if ($.trim($("#easy").val()) != "" && $.trim($("#medium").val()) == "" && $.trim($("#hard").val()) != "")
							 {
								total=parseInt($('#easy').val(),10)+parseInt($('#hard').val(),10);
								
								if(total < 0 ||total > 100)
								{
							        
						            $(this).val('') ;
								}
							}

						if ($.trim($("#easy").val()) != "" && $.trim($("#medium").val()) != "" && $.trim($("#hard").val()) == "")
							 {
								total=parseInt($('#easy').val(),10)+parseInt($('#medium').val(),10);
								
								if(total < 0 ||total > 100)
								{
							        
						            $(this).val('') ;
								}
							}
						

						if ($.trim($("#easy").val()) != "" && $.trim($("#medium").val()) != "" && $.trim($("#hard").val()) != "")
							 {
								total=parseInt($('#easy').val(),10)+parseInt($('#medium').val(),10)+parseInt($('#hard').val(),10);
								
								if((total) !== 100)
								{
							        
						            $(this).val('') ;
								}
							}

 
						});

					});
function myFunction() {
    var x = document.getElementById("snackbar")
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
    </body>

</html>