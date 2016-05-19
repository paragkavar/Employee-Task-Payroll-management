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
    	<h2>Team</h2>
	</div>

<?php
session_start();
 //   include("header.php");
	include("dbconnection.php"); 
		
	$txtb = mysql_query("select * from project where projectid='$_POST	[projid]'");
	while($rowsrec = mysql_fetch_array($txtb))
		{
		$projectid = $rowsrec[projectid];
		$projectname = $rowsrec[projectname];
		}
if(isset($_POST["submit"]))
{
$insdb ="INSERT INTO team(empid,teaminfo,projectid,branchid,comment) VALUES('$_SESSION[emid]','$_POST[teaminfo]', '$_POST[proid]','$_SESSION[brid]','$_POST[comment]')";
mysql_query($insdb,$con);
}

	$txtc = mysql_query("select * from team where empid='$_SESSION[emid]'");
	
	?>
    <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        <?php
		if(isset($_POST[projid]))
		{
		?>
        	<div class="header_02">Create Team</div>
       	  <form id="form1" name="form1" method="post" action="">
            <table width="713" height="212" border="0">
              <tr>
                <th width="143" height="33" scope="row">Project Name</th>
                <td width="560">
                <input type="hidden" name="proid" value="<?php echo $projectid; ?>" />
                <input name="projectid" type="text"  id="projectname" value="<?php echo $projectname; ?>" size="50" align="right" readonly="readonly"/></td>
              </tr>
              <tr>
                <th height="59" scope="row"  >Team Info</th>
                <td><textarea name="teaminfo" cols="39" id="teaminfo" align="right"></textarea></td>
              </tr>
              <tr>
                <th height="56" scope="row"><label for="comment2">Comment</label></th>
                <td><textarea name="comment" cols="39" id="comment" align="right"></textarea></td>
              </tr>
              <tr>
                <th colspan="2" scope="row"><input type="submit" name="submit" id="submit" value="Create Team for <?php echo $projectname; ?> project" />                  <input type="reset" name="reset" id="reset" value="Reset" /></th>
              </tr>
            </table>
       	  </form>
          <?php
		}
		  ?>
          <div class="header_02">Current Development Projects</div>
          <table width="609" border="1">
            <tr>
              <th width="54" scope="col">Team ID</th>
              <th width="143" scope="col">Project Name</th>
              <th width="267" scope="col">Team Info</th>
              <th width="117" scope="col">Task info</th>
            </tr>
         <?php
		    while($rowsreca = mysql_fetch_array($txtc))
		{
		?>
            <tr>
              <td height="42">&nbsp;<?php echo $rowsreca[teamid]; ?></td>
              <td>&nbsp;<?php 
			  
			  $txtd = mysql_query("select * from project where projectid='$rowsreca[projectid]'");
			  $rowsrecd = mysql_fetch_array($txtd);
			  echo $rowsrecd[projectname]; 
			  
			  ?></td>
              <td><?php echo $rowsreca[teaminfo]; ?>No. of Employees working for this project</td>
              <td align="center"> <a href="task.php?teamid=<?php echo $rowsreca[teamid]; ?>"><strong>View</strong></a><strong></strong></td>
            </tr>
         <?php
		}
		?>
          </table>
          <div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
            <div class="cleaner"></div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        
        	<div class="content_right_section">
            	
                 <?php
			   if(isset($_SESSION[emid]))
				{
			  // include("empsidebar.php");
				}
				else
				{
			//	include("adminsidebar.php");
				}
			   ?>
                
                
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