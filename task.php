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
    	<h2>Tasks</h2>
	</div> <!-- end of middle -->

<?php
session_start();

//include("header.php");
include("dbconnection.php");

if(isset($_POST[submit]))
{

$docfile = $_FILES["file"]["name"];
move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);

$insdb ="INSERT INTO task(teamid,employeeid,task,others,documents) 
VALUES ('$_POST[teamid]','$_POST[employee]', '$_POST[task]','$_POST[others]','$docfile')";
mysql_query($insdb,$con);
}
	$txtc = mysql_query("select * from team where teamid='$_GET[teamid]'");
	$rowsrecd = mysql_fetch_array($txtc);
	$proinfo =$rowsrecd[teaminfo];

	$txtd = mysql_query("select * from employees where branchid='$_SESSION[brid]' AND emptype='Employees'");
?>
    <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        	<div class="header_02">Task information</div>
    <?php
		  if($_SESSION["logintype"] != "Admin")
		  {
		  ?>          
       	  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <table width="500" height="224" border="0">
              <tr>
                <th height="40" scope="row">Team info</th>
                <td>&nbsp;<input type="hidden" value="<?php echo $_GET[teamid]; ?>" name="teamid" />
              <?php
             echo $proinfo;
         ?>
                </td>
              </tr>
              <tr>
                <th scope="row">Select Employee</th>
                <td><label for="employee"></label>
                  <select name="employee" id="employee">
                  <?php
				  while($rw = mysql_fetch_array($txtd))
				  {
					  echo "<option value='$rw[empid]'>$rw[fname] $rw[lname]</option>";
				  }
				  ?>
                </select></td>
              </tr>
              <tr>
                <th scope="row"><label for="task2">Task</label>
&nbsp;</th>
                <td><input name="task" type="text"  id="task" size="50" align="right"/></td>
              </tr>
              <tr>
                <th scope="row"><label for="others2">Task Info</label></th>
                <td><textarea name="others" id="others" align="right"></textarea></td>
              </tr>
              <tr>
                <th scope="row"><label for="documents2">Documents</label></th>
                <td><input type="file" name="file" id="file" /></td>
              </tr>
              <tr>
                <th height="38" scope="row">&nbsp;</th>
                <td><input type="submit" name="submit" id="submit" value="Submit" />
                <input type="reset" name="reset" id="reset" value="Reset" /></td>
              </tr>
            </table>
       	  </form>
          
<?php
}
?>
          <table width="498" border="0">
            <tr bgcolor="#99CCFF">
              <th scope="col">Employee Name</th>
              <th scope="col">Task</th>
              <th scope="col">Task info</th>
              <th scope="col">Documents</th>
            </tr>
        <?php
		$txtef = mysql_query("select * from task where teamid='$_GET[teamid]'");
		while($arrrecs = mysql_fetch_array($txtef))
		{
			$txtefg = mysql_query("select * from employees where empid='$arrrecs[employeeid]'");
		while($arrg = mysql_fetch_array($txtefg))
		{
			$names = $arrg[fname]. " " . $arrg[lname];
		}
            echo "<tr>			
              <td>&nbsp;
			  $names
			  </td>
              <td>&nbsp;$arrrecs[task]</td>
              <td>&nbsp;$arrrecs[others]</td>
              <td>&nbsp;<a href='upload/$arrrecs[documents]'>$arrrecs[documents]</a></td>
            </tr>";
		}
		?>
          </table>
          <p>&nbsp;</p>
      <div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
            <div class="cleaner"></div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        
       	  <div class="content_right_section">
            	

   				<?php
			   if(isset($_SESSION[emid]))
				{
			   include("empsidebar.php");
				}
				else
				{
				//include("adminsidebar.php");
				}
			   ?>

            <div class="margin_bottom_20"></div>
            <div class="margin_bottom_20"></div>
            <div class="margin_bottom_20"></div>
       	  </div>
            
        </div> <!-- end of content right -->
        
        <div class="cleaner"></div>
        
    </div>
    
                
              <div class="news_section">
                <div class="news_image"></div>
              </div>
                
              <div class="margin_bottom_20"></div>
              <div class="margin_bottom_20"></div>
                <div class="margin_bottom_20"></div>
        	</div>
            
        </div> <!-- end of content right -->
        
        <div class="cleaner"></div>
        
    </div>
   <?php
 //  include("footer.php");
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