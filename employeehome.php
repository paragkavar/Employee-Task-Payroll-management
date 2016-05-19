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
<style type="text/css" media="screen">
#horizontalmenu ul {
padding:5; 
margin:5;
 list-style:none;
}

#horizontalmenu li {
float:left; position:relative; padding-right:50px; display:block;
border:0px solid #CC55FF; 
border-style:inset;
}

#horizontalmenu li ul {
    display:none;
position:absolute;
}

#horizontalmenu li:hover ul{
    display:block;
    background:red;
height:auto; width:8em; 
}

#horizontalmenu li ul li{
    clear:both;
border-style:none;}
</style>
</head>
<body>
<div id="tooplate_body_wrapper">
<div id="tooplate_wrapper">
	<div id="tooplate_top_bar">
    	<a class="social_btn twitter">&nbsp;</a>
        <a class="social_btn facebook">&nbsp;</a>
    </div>	
    
    <div id="tooplate_header">
        <div id="site_title"><h1><a href="#">Online Employee Task & Payroll Management System</a></h1></div>
		<br/><br/>
		<b><font color="gold" size="5"> Online Employee Task & Payroll Management System</font></b>
       <br/><br/><br/>

	  <div id="horizontalmenu">
        <ul> <li><a href="employeehome.php" class="current">Emp Home</a></li>
			<li><a href="viewproject.php">View Project</a></li>		
			 <li><a href="team.php">Team</a></li>
			<li><a href="task.php">Task</a></li>  
				  <li><a href="inbox.php">Messages</a></li>
			<li><a href="viewsalary.php">Salary report</a>
            <li><a href="logout.php">Logout</a></li>
        </ul>
</div>
 <!-- end of tooplate_menu -->
    </div> <!-- end of forever header -->
     <div id="tooplate_middle_subpage">
    	<h2>Employee home</h2>
	</div>

<?php
session_start();
$timezone = "Asia/Calcutta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
//include("header.php");
include("dbconnection.php");
$logindt = date("Y-m-d");
$qresult=mysql_query("SELECT * FROM attendance WHERE logintime >  '$logindt 00:00:00' AND logintime <  '$logindt 23:59:59' AND empid ='$_SESSION[emid]'");
$counts = mysql_num_rows($qresult);
$attid = date("Y-m-d h:i:s");
		if(isset($_POST["login"]))
		{
		$insdb ="INSERT INTO attendance(empid,logintime) VALUES ('$_SESSION[emid]','$attid')";
		mysql_query($insdb,$con);
		$affrow = mysql_affected_rows();
		   if($affrow == 1)
		   {
			  $att = "Employee logged in successfully..."; 
		   }
		$_SESSION["emplogin"] ="SET";
		}

		if(isset($_POST["logout"]))
		{
			$attid = date("Y-m-d h:i:s");
		$insdb ="UPDATE attendance SET logout='$attid' where empid='$_SESSION[emid]' ";
		mysql_query($insdb,$con);
		$affrow = mysql_affected_rows();
		   if($affrow == 1)
		   {
			  $att = "Employee logged Out successfully..."; 
		   }
		}
$qresult=mysql_query("SELECT * FROM attendance WHERE logintime >  '$logindt 00:00:00' AND logintime <  '$logindt 23:59:59' AND empid ='$_SESSION[emid]'");
$counts = mysql_num_rows($qresult);

echo date('d-m-Y H:i:s');
	?>
    <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        <!--	<div class="header_02">Employee home</div> -->
       	  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
       	    <table width="500" height="296" border="0">
              <tr>
                <th colspan="2" scope="row" bgcolor="#CCFFFF"><p>Welcome <?php echo $_SESSION["ename"]; ?>
                </p>
                <?php
                if($affrow == 1)
				{
				echo $att; 
				}
				?>
              </tr>
              <tr>
                <th scope="row">Employee ID</th>
                <td>&nbsp;<?php echo $_SESSION["emid"]; ?></td>
              </tr>
              <tr>
                <th scope="row">Login ID</th>
                <td>&nbsp;<?php echo $_SESSION["login"]; ?></td>
              </tr>
              <tr>
                <th scope="row">Branch Name</th>
                <td>&nbsp;<?php 
				$txtb = mysql_query("select * from branch where branchid='$_SESSION[brid]'");
				$rowsrec = mysql_fetch_array($txtb);
				echo $rowsrec["branchname"]; 
				?></td>
              </tr>
              <?php
			  if($counts == 0)
			  {
			  ?>
              <tr>
                <th scope="row"><label for="logintime2">Login Time </label></th>
                <td><input name="logintime" type="text" id="logintime" size="35" value="<?php echo date("d-m-Y h:i:s"); ?>" readonly/></td>
              </tr>
              <?php
			  }
			  else
			  {
			  ?>
              <tr>
                <th scope="row"><label for="logout">Logout</label></th>
                <td><input name="logout2" type="text" id="logout2" size="35" value="<?php echo date("d-m-Y h:i:s"); ?>" readonly /></td>
              </tr>
              <?php
			  }
			  ?>
              <tr>
                <th scope="row">&nbsp;</th>
                <td>
                 <?php
			  if($counts == 0)
			  {
			  ?>
                <input type="submit" name="login" id="login" value="Login" />             
                  <?php
			  }
			  else
			  {
			  ?>
                <input type="submit" name="logout" id="logout" value="logout" />
                 <?php
			  }
			  ?>	 
                </td>
              </tr>
            </table>
       	  </form>
          <p>&nbsp;</p>
<div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
            <div class="cleaner"></div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        
        	<div class="content_right_section">
     <?php
			 if($_SESSION["loginid"] == "admin")
			 {
			//	include("adminsidebar.php");
			 }
			 else
			 {
			//	 include("empsidebar.php");
			 }
	?>
        	  <div class="news_section">
                <div class="news_content">
                      <div class="news_title"></div>
                </div>
              </div>
                
              <div class="margin_bottom_20"></div>
              <div class="margin_bottom_20"></div>
              <div class="margin_bottom_20"></div>
        	</div>
            
        </div> <!-- end of content right -->
        
        <div class="cleaner"></div>
        
    </div>
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