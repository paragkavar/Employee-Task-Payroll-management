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
    	<h2>Projects</h2>
	</div> <!-- end of middle -->


<?php
	session_start();
   // include("header.php");
	include("dbconnection.php");
	if(isset($_POST["updateproject"]))
	{
		if(!$_FILES['file']['name'])
		{ 
		 $myfiles =$_POST["files"];
		}
		else
		{
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
		$myfiles =$_FILES["file"]["name"];
		}
		$updtrec = mysql_query("UPDATE project SET projectname='$_POST[projectname]',projectdescription='$_POST[description]',branchid='$_POST[branchname]',startdate='$_POST[startdate]',enddate='$_POST[enddate]',noofdays='$_POST[noofdays]',projectdocs='$myfiles' where projectid = '$_POST[projid]'");
		$msgrec = "Project record updated successfully...";
	}
	
	if(isset($_POST["delproject"]))
	{
		mysql_query("DELETE from project where projectid = '$_POST[projid]'");
		$msgrec = "Project record deleted successfully...";
	}
	
	$startdate = $_POST[startdate];
$sdt = date("Y-m-d", strtotime($startdate));

$enddate = $_POST[enddate];
$edt = date("Y-m-d", strtotime($enddate));
	
	
	if(isset($_POST["addproject"]))
	{		
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
		$myfiles =$_FILES["file"]["name"];
		
$insdb ="INSERT INTO project(projectname,projectdescription,branchid,startdate,enddate,noofdays,projectdocs,projectstatus) VALUES 
('$_POST[projectname]','$_POST[description]','$_POST[branchname]','$sdt', '$edt','$_POST[noofdays]','$myfiles','Pending')";
	
	mysql_query($insdb,$con); 
	}
	
	$txtb = mysql_query("select * from project where projectid='$_GET[proids]'");
	while($rowsrec = mysql_fetch_array($txtb))
		{
		$projectid = $rowsrec[projectid];
		$projectname = $rowsrec[projectname];
		$projectdescription = $rowsrec[projectdescription];
		$brid = $rowsrec[branchid];	
		$stdate = $rowsrec[startdate];	
		$enddate = $rowsrec[enddate];	
		$nodays = $rowsrec[noofdays];	
		$projdocs = $rowsrec[projectdocs];	
		$projst = $rowsrec[projectstatus];
		}
	
	$txt=mysql_query("select * from branch");
	$txta=mysql_query("select * from employees where emptype='Branch Manager'");

	$txtd = mysql_query("select * from team where projectid='$_GET[proids]'");
	$txte = mysql_num_rows($txtd);
	
	?>
 
    <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        	<div class="header_02">
        	   <?php
			   if(isset($_GET[proids]))
				{
             	 echo "<p>View projects     	</p>";
				}
				else
				{
				 echo "<p>Add A New projects     	</p>";
				}
				?>
        	</div>
              	
            <div>
            <?php
 if(isset($_SESSION["logintype"]))
				{
				?>
            <a href="viewproject.php"><strong>View Project</strong></a>
            	<?php
				}
				?>
            </div>
       	 
          <?php
		
		  if($_SESSION["logintype"]=="Admin")
		  {
		  ?>
           <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <table width="498" height="363" border="3">
            <tr>
              <th colspan="2" scope="row">&nbsp;<?php echo $msgrec; ?></th>
            </tr>
            <tr>
              <th width="175" scope="row"><label for="projectname">Project Name</label>              </th>
              <td width="313">
              <input type="hidden" name="projid" value="<?php echo $projectid; ?>"/>
              <input name="projectname" type="text" id="projectname" size="50" value="<?php echo $projectname; ?>"/></td>
            </tr>
            <tr>
              <th scope="row"><label for="description2">Description</label>              </th>
              <td><textarea name="description" cols="35" id="description"><?php echo $projectdescription; ?></textarea></td>
            </tr>
            <tr>
              <th height="36" scope="row"><label for="branchname2">Branch Name</label>              </th>
              <td>   <select name="branchname" id="branchname">
              <option></option>
              <?php
              while($row = mysql_fetch_array($txt))
  				{
			if($row['branchid'] == $brid)
			{  
			echo "<option value='". $row['branchid'] . "' selected='selected'>" . $row['branchname']. "</option>";
			}
			else
			{
				echo "<option value='". $row['branchid'] . "'>" . $row['branchname']. "</option>";
			}
				}
			?>
              </select></td>
            </tr>
            <tr>
              <th scope="row">Start Date</th>
              <td>
              <script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>
	  		<input type="Text" name="startdate" id="startdate" maxlength="25" size="25" value="<?php echo $stdate; ?>"><a href="javascript:NewCal('startdate','ddmmmyyyy',false,24)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="enddate2">End Date</label>              </th>
              <td>
                        <script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>
<input type="Text" name="enddate" id="enddate" maxlength="25" size="25" value="<?php echo $enddate; ?>"><a href="javascript:NewCal('enddate','ddmmmyyyy',false,24)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>
              
              </td>
            </tr>
            <tr>
              <th scope="row"><label for="noofdays2">No Of Days</label>              </th>
              <td><input type="text" name="noofdays" id="noofdays"  value="<?php echo $nodays; ?>"/></td>
            </tr>
            <tr>
              <th height="49" scope="row"><label for="projectdocument2">Project Document</label>              </th>
              <td><input type="file" name="file" id="file"/>
              <input type="hidden" name="files" id="files" value="<?php echo $projdocs; ?>" />
               <br>
			    
			   <?php 
			  if(isset($_GET[proids]))
			  {
			   echo "<a href='upload/$projdocs'>$projdocs</a> ";
			  }
			   ?>
               
              </td>
            </tr>
            <tr>
              <th colspan="2" scope="row">

              <?php
				  if(isset($_GET[proids]))
				  {
				  ?>
				  <input type="submit" name="updateproject" id="updateproject" value="Update Project" />
				  <input type="submit" name="delproject" id="delproject" value="Delete Project" />
				  <?php
				  }
				  else
				  {
				  ?>
				  <input type="submit" name="addproject" id="addproject" value="Add Project" />
				  <?php
				  }
				  ?>
              </th>
            </tr>
          </table>
           </form>
          <?php
		  }
		  else
		  {
		  ?>
          
          <table width="498" height="321" border="0">
            <tr>
              <th width="175" height="27" scope="row"><label for="projectname">Project Name</label>              </th>
              <td width="313">
              <input type="hidden" name="projid" value="<?php echo $projectid; ?>"/>
            <?php echo $projectname; ?></td>
            </tr>
            <tr>
              <th scope="row"><label for="description2">Description</label>              </th>
              <td><?php echo $projectdescription; ?></td>
            </tr>
            <tr>
              <th height="36" scope="row"><label for="branchname2">Branch Name</label>              </th>
              <td> 
              <?php
              while($row = mysql_fetch_array($txt))
  				{
			if($row['branchid'] == $brid)
			{  
			echo  $row['branchname'];
			}
				}
			?>
			</td>
            </tr>
            <tr>
              <th scope="row">Start Date</th>
              <td><?php echo $stdate; ?></td>
            </tr>
            <tr>
              <th scope="row"><label for="enddate2">End Date</label>              </th>
              <td><?php echo $enddate; ?></td>
            </tr>
            <tr>
              <th scope="row"><label for="noofdays2">No Of Days</label>              </th>
              <td><?php echo $nodays; ?></td>
            </tr>
            <tr>
              <th height="49" scope="row"><label for="projectdocument2">Project Document</label>              </th>
              <td>			    
			   <?php 
			  if(isset($_GET[proids]))
			  {
			   echo "<a href='upload/$projdocs'>$projdocs</a> ";
			  }
			   ?>
               
              </td>
            </tr>
            <tr>
              <th height="49" scope="row">Team Info</th>
              <th height="49" scope="row">
<form method="POST" action="team.php">
<input type="hidden" name="projid" value="<?php echo $_GET[proids]; ?>" id="projid" />
              <?php
			  if($txte==0)
			  {
				  ?>	
   		  
              <input type="submit" name="createteam" id="createteam" value="Create Team" />
            <?php
			  }
			  else
			  {
				  ?>
                  <input type="submit" name="createteama" id="createteama" value="View Team Info" />

                  <?php
			  }
			  ?>
              </th>
            </tr>

          </table>  </form>
          <?php
		  }
		  ?>
       	 
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
			//	include("adminsidebar.php");
				}
			   ?>
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