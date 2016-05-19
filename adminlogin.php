
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Employee payroll and Task management system</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<!--
Template 2034 Iron Rush
http://www.tooplate.com/view/2034-iron-rush
-->
<link href="css/tooplate_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:15,
		animSpeed:500,
		pauseTime:3000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>



</head>
<body>
<?php
session_start();
?>
<script>
function validateFormad()
{
var y=document.forms["form2"]["Loginid"].value;
var passw = document.forms["form2"]["password"].value;
if (y==null || y=="")
  {
  alert("Login ID must be filled out");
  return false;
  }
  
  if (passw==null || passw=="")
  {
  alert("Password must be filled out");
  return false;
  }
}
</script>

<?php
  //  include("header.php");
	// include("slider.php");
	include("dbconnection.php"); 
	
	if(isset($_SESSION["loginid"]))
	{
		header("Location: adminhome.php");
	}
	
if(isset($_POST["submit"]))
{
		$result = mysql_query("SELECT * FROM employees
	WHERE loginid='$_POST[Loginid]' AND password='$_POST[password]' AND emptype='Admin'");

	if(mysql_num_rows($result) == 1)
	{
		while($row = mysql_fetch_array($result))
		{
			$_SESSION["logintype"] = "Admin";
			$_SESSION[empid] = $row[empid];
			$_SESSION[names] =  $row[fname]. " ". $row[lname];
		}
		$_SESSION["loginid"] = $_POST[Loginid];
		header("Location: adminhome.php");
	}
	else
	{
		echo "<script type='text/javascript'>alert('Invalid Login ID and Password entered')</script>";
	}

}
	?>


<div id="tooplate_body_wrapper">
<div id="tooplate_wrapper">
	<div id="tooplate_top_bar">
    	<a class="social_btn twitter">&nbsp;</a>
        <a class="social_btn facebook">&nbsp;</a>
    </div>	
    
    <div id="tooplate_header">
        <div id="site_title"><h1><a href="#">Online Employee Task & Payroll Management System</a></h1></div>
        <div id="tooplate_menu">
            <ul>
                <li><a href="index.php" >Home</a></li>
                <li><a href="adminlogin.php" class="current">Administrator Login</a></li>
                <li><a href="employeelogin.php">Employee Login</a></li>
                <li><a href="gallery.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>    	
        </div> <!-- end of tooplate_menu -->
    </div> <!-- end of forever header -->
    
    
     <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        	<div class="header_02">Administrator Login Page</div>
            <div class="image_frame_02"><a href="#"><img src="images/adminlogin.jpg" alt="image" /></a></div>
            <p class="bi_para">&nbsp;</p>
<div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
   <?php
			if(isset($_SESSION["login"]))
{
echo "You already logged in<br>";
?>
   <button onclick="window.location.href='adminhome.php'">Continue</button>
<?php
}
else
{
	?>	 
	

<style>
#form1{
    border-style:solid;
    border-width:5px;	
    border-color:red green blue yellow;
	padding: 20px;
}
</style>	
	
	<div id="form1">
			 <form id="form2" name="form2" method="post" action="" onsubmit="return validateFormad()">
               <p>&nbsp;<?php echo $msg; ?></p>
                <p>
                  <label for="Loginid" >Login ID</label>
                </p>
                <p>
                  <input name="Loginid" type="text" id="Loginid" size="45" />
                </p>
                <p>
                  <label for="password">Password<br />
                  </label>
                  <input name="password" type="password" id="password" size="45" />
                </p>
             
                <p> 
                  <input type="submit" name="submit" id="submit" value="Login here" />
                  <input type="reset" name="submit2" id="submit2" value="Reset" />
                </p>
               
              </form>
			  </div>
<?php
}
?>
            
            <div >
    
        <div class="cleaner"></div>
    </div> <!-- end of main -->

	<div class="cleaner"></div>
</div> <!-- end of forever wrapper -->
</div> <!-- end of forever body wrapper -->
<br/><br/><br/><br/>


<div id="tooplate_footer_wrapper">
	<div id="tooplate_footer">
    	<div class="col_w200 float_l">
        	<h4>Pages</h4>
            <ul class="tooplate_list">
                <li><a href="http://1-cloud.net/">OneCloud Consulting</a></li>
            </ul>
        </div>
        <div class="col_w200 float_r col_last">
        	<h4>Contact Us</h4>
            OneCloud Consulting <br />
           WhiteField <br />
            Bangalore<br /><br />
            Phone: 080-2248565 <br />
            Email: <a href="mailto:info@onecloudinc.com">info@onecloudinc.com</a>
        </div>
        
        <div class="cleaner"></div>
    </div>
</div>

<div id="tooplate_copyright_wrapper">
	<div id="tooplate_copyright">
	
    	Copyright © 2016 <a href="#">OneCloud Consulting</a>
		
    </div>
</div>
</body>
</html>