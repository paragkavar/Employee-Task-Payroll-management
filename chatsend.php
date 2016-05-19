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
    	<h2>Send Chat</h2>
	</div> <!-- end of middle -->


<?php
session_start();
include("dbconnection.php");

if(isset($_POST["Message"]))
{
$insdb ="INSERT INTO chat(senderid,message) VALUES ('$_SESSION[emid]','$_POST[mess]')";
$recc = mysql_query($insdb,$con);
}
?>
<html> 
<head> 
<title>Chat Box</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<script> 
function createRequestObject() { 
var ro; 
var browser = navigator.appName; 
if(browser == "Microsoft Internet Explorer"){ 
ro = new ActiveXObject("Microsoft.XMLHTTP"); 
}else{ 
ro = new XMLHttpRequest(); 
} 
return ro; 
} 

var http = createRequestObject(); 

function sndReq() { 
http.open('get', 'chatview.php'); 
http.onreadystatechange = handleResponse; 
http.send(null); 
setTimeout("sndReq()", 2000); // Recursive JavaScript function calls sndReq() every 2 seconds 
} 

function handleResponse() { 
if(http.readyState == 4){ 
var response = http.responseText; 
if (response != responseold || responsecheck != 1) { 
var responsecheck = 1; 
document.getElementById("messages").innerHTML = http.responseText; 
var responseold = response; 
} 
} 
} 
</script> 

</head> 
<body onLoad="javascript:sndReq();"> 
<div id="messages"></div> 
<p><strong>Send Message:</strong></p>
<form name="form1" method="post" action="">
  <p>
    <label for="mess"></label>
    <textarea name="mess" id="mess"   cols='45' rows='5'></textarea>
  </p>
  <p>
    <input type="submit" name="Message" id="Message" value="Send Message">
  </p>
</form>
<p>&nbsp;</p>
</body> 
</html>