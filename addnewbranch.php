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
    	<h2>Branches</h2>
	</div> <!-- end of middle -->




<?php
session_start();
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getState(countryId) {		
		var strURL="findState.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
</script>
<script>
function validateFormadbr()
{
var bn=document.forms["formadb"]["branchname"].value;
var addr = document.forms["formadb"]["address"].value;
var city= document.forms["formadb"]["city"].value;
var state = document.forms["formadb"]["state"].value;
var coun = document.forms["formadb"]["country"].value;
var contno = parseInt(document.forms["formadb"]["contactno"].value);

		 if (isNaN(contno)) 
		 {
			alert("Please enter a number only.");
				  return false;
		 }
		  if (bn==null || bn=="")
		  {
		  alert("Branch name must be filled out");
		  return false;
		  }
		  
		  if (addr==null || addr=="")
		  {
		  alert("Address must be filled out");
		  return false;
		  }
		  
		  if (city==null || city=="")
		  {
		  alert("City must be filled out");
		  return false;
		  }
		  
		  if (state==null || state=="")
		  {
		  alert("State must be filled out");
		  return false;
		  }
		  
		   if (coun==null || coun=="")
		  {
		  alert("Country must be filled out");
		  return false;
		  }
		  
		   if (contno==null || contno=="")
		  {
		  alert("Contact No must be filled out");
		  return false;
		  }


}

</script>

<?php
    //include("header.php");
	//include("slider.php");
	include("dbconnection.php");
	
	if(isset($_POST[addbranch]))
	{
		$sql="INSERT INTO branch (branchname,address,city,state,country,contactno) VALUES ('$_POST[branchname]','$_POST[address]','$_POST[city]','$_POST[state]','$_POST[country]','$_POST[contactno]')";
	
		if (!mysql_query($sql,$con))
		{
		die('Error: ' . mysql_error());
		}
		if(mysql_affected_rows())
		{
			$brad = "New branch record inserted successfully...";
		}
	}
	
		if(isset($_POST[updatebtn]))
		{
		mysql_query("UPDATE branch SET branchname='$_POST[branchname]',address='$_POST[address]',city='$_POST[city]',state='$_POST[state]',country='$_POST[country]',contactno='$_POST[contactno]' where branchid='$_POST[brid]'");
		header("Location: addnewbranch.php");
		}
		if(isset($_POST[updatebtna]))
		{
		header("Location: addnewbranch.php");
		}
		if(isset($_POST[deletebtn]))
		{
				mysql_query("DELETE FROM branch where branchid='$_POST[brid]'");
						header("Location: addnewbranch.php");
		}
	
			$branchreca  =mysql_query("select * from branch where branchid='$_GET[brids]'");
			
			$arrvara=mysql_fetch_array($branchreca);
			
			$brid =$arrvara[branchid];
			$brname = $arrvara[branchname];
            $brcity = $arrvara[city];
            $brstate = $arrvara[state];
			$brcountry = $arrvara[country];
			$brcont = $arrvara[contactno];
			$braddress = $arrvara[address];
        		
	?> 
<div id="templatemo_content">
   	
    <div id="templatemo_content_left">
        	<div class="header_02">Add/Update A New Branch</div>

          <form id="formadb" name="formadb" method="post" action="" onsubmit="return validateFormadbr()">
       
            <table width="500" border="3">
              <tr>
                <th scope="col">&nbsp;</th>
                <th scope="col" align="left">&nbsp;<?php echo $brad; ?></th>
              </tr>
              <tr>
                <th scope="col"><strong>Branch Name</strong></th>
                <th scope="col" align="left">
                <input type="hidden" name="brid" id="brid" value="<?php echo $_GET[brids]; ?>"/>
                <input type="text" name="branchname" id="branchname"  value="<?php echo $brname; ?>"/></th>
              </tr>
              <tr>
                <td><strong>
                  <label for="address2">Address</label>
                </strong></td>
                <td><textarea name="address" id="address" cols="45" rows="5"><?php echo $braddress; ?></textarea></td>
              </tr>
              <tr>
                <td><strong>
                  <label for="city2">City</label>
                </strong></td>
                <td><input type="text" name="city" id="city"  value="<?php echo $brcity; ?>"/></td>
              </tr>
                <tr>
                <td><strong>
                  <label for="country2">Country</label>
                </strong></td>
                <td>
                 <?php
			$arr = array("India", "Sri lanka", "Australia");
			?>
            <select name="country" id="country"  onChange="getState(this.value)">
              <option value="">Select country</option>
              <?php
			  foreach($arr as $value)
			  {
				   if($value == $brcountry)
					 {
					 echo "<option value='$value' selected>$value</option>";
					 }
					 else
					 {
					 echo "<option value='$value'>$value</option>";
					 }
			  }
			  ?>
            </select>
				</td>
              </tr>
              <tr>
                <td><strong>
                  <label for="state2">State</label>
                </strong></td>
                <td>
                <?php
				$arrcont = array("New Delhi","Karnatka","Kerala","Tamil Nadu","Others");
				?>
               <div id="statediv">
               
               <select name="state" id="state">
               <option value="Select state">Select state</option>
              <?php
				 foreach($arrcont as $value)
				 {
					 if($value == $brstate)
					 {
					 echo "<option value='$value' selected>$value</option>";
					 }
					 else
					 {
					 echo "<option value='$value'>$value</option>";
					 }
				 }
				 ?>
            </select></div>
               </td>
              </tr>
            
              <tr>
                <td><strong>
                  <label for="contactno3">Contact No</label>
                </strong></td>
                <td><input type="text" name="contactno" id="contactno"  value="<?php echo $brcont; ?>" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>
                <?php
				if(isset($_GET[brids]))
				{
				?>
    	            <input type="submit" name="updatebtn" id="updatebtn" value="Update Branch" />
	                <input type="submit" name="deletebtn" id="deletebtn" value="Delete Branch" />
                    <input type="submit" name="updatebtna" id="updatebtna" value="Cancel" />
                <?php
				}
				else
				{
				?>
					<input type="submit" name="addbranch" id="addbranch" value="Add Branch" />
				  <?php
				}
				?>
                </td>
              </tr>
            </table>
          </form>
          <table width="500" border="1">
            <tr>
              <th width="142" scope="col"><label for="branchname2">Branch Name</label></th>
              <th width="45" scope="col">City</th>
              <th width="200" scope="col"><label for="contactno2">State</label></th>
              <th width="85" scope="col">Country</th>
                      <th width="85" scope="col">Contact no</th>
            </tr>
            <?php
			$branchrec  =mysql_query("select * from branch");
			while($arrvar=mysql_fetch_array($branchrec))
			{
				
				echo "        <tr>
              <td>&nbsp;<a href='addnewbranch.php?brids=$arrvar[branchid]'>$arrvar[branchname]</a></td>
              <td>&nbsp;$arrvar[city]</td>
              <td>&nbsp;$arrvar[state]</td>
			       <td>&nbsp;$arrvar[country]</td>
				   			       <td>&nbsp;$arrvar[contactno]</td>
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
			 if($_SESSION["logintype"] = "Admin")
			 {
				//include("adminsidebar.php");
			 }
			 else
			 {
				 include("empsidebar.php");
			 }
				?>
                
        <div class="news_section">
                  <div class="news_image"></div>
                <div class="news_content">
                      <div class="news_title"></div>
          </div>
              </div>
                <div class="news_section">
                  <div class="news_content"> </div>
              </div>
                
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