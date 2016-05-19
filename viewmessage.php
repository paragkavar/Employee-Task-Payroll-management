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
    	<h2>View Message</h2>
	</div> <!-- end of middle -->



<?php
session_start();
  //  include("header.php");
	include("dbconnection.php");
$dttim = date("Y-m-d h:i:s");

	$result = mysql_query("SELECT * FROM message where msgid='$_GET[msgid]'");
	
     while($row = mysql_fetch_array($result))
  {
	  	$msgid = $row[msgid];
	  	$sender = $row[senderid];
		$receiver =	$row[receiverid];
		$msgtitle =	$row[msgtitle];
		$msg =	  	$row[msg];
		$tdatetime = $row[datetime];
  }
  
  $resulta = mysql_query("SELECT * FROM message where replyid='$_GET[msgid]'");
  $replycount = mysql_num_rows($resulta);
	?>
    <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        	<div class="header_02"><a href="inbox.php">Inbox</a></div>
       	  <p class="bi_para"><a href="message.php">Send Message</a>&nbsp;<?php echo $msgres; ?></p>
       	  <form id="form1" name="form1" method="post" action="message.php">
       	    <table width="500" border="1">
       	      <tr>
       	        <th colspan="2" scope="col">View message</th>
   	          </tr>
       	      <tr>
       	        <td width="125" height="30"><strong>Sender : 
       	          
       	        </strong></td>
       	        <td width="359">&nbsp; <strong><?php echo $sender; ?></strong></td>
   	          </tr>
       	      <tr>
       	        <td height="29"><strong>Date Time :  </strong></td>
       	        <td>&nbsp; <strong><?php echo $dttim; ?></strong></td>
   	          </tr>
       	      <tr>
       	        <td height="33"><strong>Message title :</strong></td>
       	        <td height="33">&nbsp; <strong><?php echo $msgtitle; ?></strong></td>
   	          </tr>
       	      <tr>
       	        <td height="107" valign="top"><strong>Message: </strong></td>
       	        <td height="107" valign="top">&nbsp; <strong><?php echo $msg; ?></strong></td>
   	          </tr>
       	      <tr>
       	        <td>&nbsp;</td>
       	        <td>
                <input type="hidden" name="messageid" value="<?php echo $msgid; ?>" />
                <input type="hidden" name="senderid" value="<?php echo $sender; ?>" />
                <input type="submit" name="reply" id="reply" value="Reply" /></td>
   	          </tr>
   	        </table>
       	  </form>
          <?php
		  if($replycount>=1)
		  {
			  echo "<p><strong>&nbsp;Replies:</strong></p>";
			     while($rowas = mysql_fetch_array($resulta))
  				{
			  ?>
          
          <table width="500" border="1">
            <tr>
              <td width="125" height="30"><strong>Sender : </strong></td>
              <td width="359">&nbsp; <strong><?php echo $rowas["senderid"]; ?></strong></td>
            </tr>
            <tr>
              <td height="29"><strong>Date Time : </strong></td>
              <td>&nbsp; <strong><?php echo $rowas["datetime"]; ?></strong></td>
            </tr>
            <tr>
              <td height="33"><strong>Message title : </strong></td>
              <td height="33">&nbsp; <strong><?php echo $rowas["msgtitle"]; ?></strong></td>
            </tr>
            <tr>
              <td height="57" valign="top"><strong>Message: </strong></td>
              <td height="57" valign="top">&nbsp; <strong><?php echo $rowas["msg"]; ?></strong></td>
            </tr>
          </table>
          <br />
          <?php
		  		}
		  }
		  ?>
          <p>&nbsp;
          
          
          </p>
<div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
            <div class="cleaner"></div>
        </div> <!-- end of content left -->
        
        <div id="templatemo_content_right">
        
        	<div class="content_right_section">
            	
             <?php
			 if($_SESSION["login"] == "admin")
			 {
			//	include("adminsidebar.php");
			 }
			 else
			 {
			//	 include("empsidebar.php");
			 }
				?>
              <div class="margin_bottom_20"></div>
              <a href="http://jigsaw.w3.org/css-validator/check/referer"></a>
            
            </div>
            
        </div> <!-- end of content right -->
        
        <div class="cleaner"></div>
        
    </div>
   <?php
//   include("footer.php");
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