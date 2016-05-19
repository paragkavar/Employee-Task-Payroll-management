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
        <ul> <li><a href="adminhome.php" class="current">Home</a></li>
			<li><a href="updateprofile.php">Admin Profile</a></li>
			
			 <li><a href="addnewbranch.php">Branch</a></li>
			<li><a href="viewemployee.php">Employees</a>
                <ul> 
				<li><a href="attendance.php">Attendance</a></li>
				  <li><a href="salary.php">Salary</a></li>
		        </ul>
            </li>
            
			
			<li><a href="addnewprojects.php">Projects</a>
		<ul><li><a href="task.php">Tasks</a></li></ul> 
		</li>
            
			<li><a href="#">Communication</a>
                <ul>  <li><a href="inbox.php">Message</a></li>
				  <li><a href="uchat.php">Chat</a></li> 
				  </ul>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
</div>
 <!-- end of tooplate_menu -->
    </div> <!-- end of forever header -->
     <div id="tooplate_middle_subpage">
    	<h2>Employee Attendance</h2>
	</div> <!-- end of middle -->


<?php
session_start();
//include("header.php");
include("dbconnection.php");
$result = mysql_query("SELECT * FROM branch");
$resultemp = mysql_query("SELECT * FROM employees where empid!='100'");
if(isset($_POST[Submit]))
{
$resultatt = mysql_query("SELECT * FROM attendance where empid='$_POST[employeename]' ");
}
else
{
	$resultatt = mysql_query("SELECT * FROM attendance");
}
?>
<div id="templatemo_content">
   
    <div id="templatemo_content_left">
        	<div class="header_02">Employees Attendance report</div>
       	  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">

          <table width="409" border="1">
            <tr>
                <th width="181" scope="row"><label for="branchname2">Branch Name</label>                </th>
                <td width="212"><select name="branchname" id="branchname" va>
          
              <option></option>
              <?php
              while($row = mysql_fetch_array($result))
  {
echo "<option value='". $row['branchid'] . "'>" . $row['branchname']. "</option>";
  }
?>
      </select></td>
              </tr>
              <tr>
                <th scope="row"><label for="employeename">Employee Name</label>                </th>
                <td><select name="employeename" id="employeename">
                   <?php
              while($row = mysql_fetch_array($resultemp))
  {
		echo "<option value='". $row['empid'] . "'>" . $row['fname']. " ". $row['lname']  ."</option>";
  }
?>
                </select></td>
              </tr>
              <tr>
                <th scope="row"><label for="month">Month
/            
            
            Year
          </label>                </th>
                <td><select name="month" id="month">
                  <option value="01">January</option>
                  <option value="02">February</option>
                  <option value="03">March</option>
                  <option value="04">April</option>
                  <option value="05">May</option>
                  <option value="06">June</option>
                  <option value="07">July</option>
                  <option value="08">August</option>
                  <option value="09">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>
                  <select name="year" id="year">
                  <?php
				  for($yr = 2013; $yr <= 2015; $yr++)
				  {
					  echo "<option value='$yr'>$yr</option>";
				  }
				  ?>
                </select></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="submit" id="submit" value="Submit" /></td>
              </tr>
            </table>
       <br />            
            <table width="614" border="1">
              <tr>
                <th width="108" scope="row"><strong>Employee ID</strong></th>
                <th width="181"><strong> Employe Name</strong></th>
                <th width="155"><strong>Login Time</strong></th>
                <th width="142"><strong>Logout Time</strong></th>
                <th width="142">&nbsp;Working hours</th>
              </tr>
              <?php
			  while($rwarray = mysql_fetch_array($resultatt))
			  {
				  $resultempa = mysql_query("SELECT * FROM employees where empid='$rwarray[empid]'");
				  $resarr = mysql_fetch_array($resultempa);
			
			$resulatt = mysql_query("SELECT TIMEDIFF(  '$rwarray[logout]',  '$rwarray[logintime]' )");
			  $resarra = mysql_fetch_array($resulatt);
              echo "<tr>			
                <td>&nbsp;$rwarray[empid]</td>
                <td>&nbsp;$resarr[fname]	$resarr[lname]</td>
                <td>&nbsp;$rwarray[logintime]</td>
                <td>&nbsp;$rwarray[logout]</td>
				   <td>&nbsp;$resarra[0]</td>
              </tr>";
			  
			  }
			  ?>
            </table>
            <p>&nbsp;</p>
          </form>
          <p>&nbsp;</p>
      <div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
            <div class="cleaner"></div>
        </div> <!-- end of content left -->
        
     
        
        	
            	
                               
                          <?php
			 if($_SESSION["logintype"] = "Admin")
			 {
				//include("adminsidebar.php");
			 }
			 else
			 {
				 include("empsidebar.php");
			 }
				?>
              <div class="margin_bottom_20"></div>
                <div class="margin_bottom_20"></div>
                <div class="margin_bottom_20"></div>
      
          </div>
            
        </div> <!-- end of content right -->
        
        <div class="cleaner"></div>
        
    </div>
   <?php
  // include("footer.php");
   ?>
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