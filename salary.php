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
    	<h2>Employee Salary</h2>
	</div> <!-- end of middle -->



<?php
session_start();
//include("header.php");
include("dbconnection.php");
//echo date("2008-03-29", "2008-03-30");
?>
<script>
function myFunction()
{
	var bsalary 	= parseFloat(document.getElementById("basicsalary").value, 10);
	var bonus 		=  parseFloat(document.getElementById("bonus").value, 10);
	var pf		 = parseFloat(document.getElementById("pf").value,10);
	var lic		 =  parseFloat(document.getElementById("lic").value,10);
		var hra	 =  parseFloat(document.getElementById("hra").value,10);
				var deduction	 =  parseFloat(document.getElementById("deduction").value,10);

	var sum = (bsalary + bonus)-(pf+lic+hra+deduction)  ;
	 document.getElementById("totalsalary").value =sum;
}
</script>
<?php
if(isset($_POST["submit"]))
{
$insdb ="INSERT INTO salary(empid,branchid,month,year,basicsalary,pf,hra,lic,totalsalary,date,bonussalary) VALUES
('$_POST[empid]','$_POST[branchid]', '$_POST[month]','$_POST[year]','$_POST[basicsalary]','$_POST[pf]','$_POST[hra]','$_POST[lic]','$_POST[totalsalary]','$_POST[date]','$_POST[bonus]')";
mysql_query($insdb,$con);
}

if(isset($_POST["submit2"]))
{
	$resulta = mysql_query("select * from branch where branchid='$_POST[branchid]' ");
		$resultb = mysql_query("select * from employees where branchid='$_POST[branchid]'");
}
else
{
	$resulta = mysql_query("select * from branch");
}

if(isset($_POST["submit3"]))
{
	$resulta = mysql_query("select * from branch where branchid='$_POST[branchid]' ");
	
	$resultb = mysql_query("select * from employees where empid='$_POST[empid]'");
	$resemp = mysql_fetch_array($resultb);
	
	//function to count number of days
	$num = cal_days_in_month(CAL_GREGORIAN, $_POST[month], $_POST[year]); 

	//function to count number of sundays
	function total_sundays($month,$year)
	{
		$sundays=0;
		$total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for($i=1;$i<=$total_days;$i++)
			if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)
				$sundays++;
		return $sundays;
	}
	$totsundays =total_sundays($_POST[month],$_POST[year]);
	
$dttim1 =  $_POST[year]."-".$_POST[month]."-01";
$dttim2 =  $_POST[year]."-".$_POST[month]."-". $num;
		$sqlatt ="SELECT * FROM  attendance  WHERE  logintime >  '$dttim1 00:00:00' AND  logout <  '$dttim2 23:59:59' AND  empid ='$_POST[empid]'";
		$resultbt = mysql_query($sqlatt);
		$resempt = mysql_num_rows($resultbt);
}


?>

    <div id="templatemo_content">
   	
        <div id="templatemo_content_left">
        	<div class="header_02">
        	  <p>Salary Detail</p>

        	</div>
                <?php echo $succ; ?><a href="viewsalary.php"><strong>View Salary</strong></a></p>
       	  <form id="form1" name="form1" method="post" action="">
            <table width="480" height="451" border="3">
              <tr>
                <th scope="row"><div align="right">Salary Date</div></th>
                <td><input name="date" type="text" id="date" value="<?php echo date("Y-m-d"); ?>" readonly="readonly" /></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;
                <div align="right">Branch Name &nbsp;&nbsp;</div></th>
                <td><label for="branchid"></label>
                  <select name="branchid" id="branchid">
                          <?php
							while($row = mysql_fetch_array($resulta))
							  {
							echo "<option value='". $row['branchid'] . "'>" . $row['branchname']. "</option>";
							  }
						  ?>
                </select>
                <input type="submit" name="submit2" id="submit2" value="Load Employees" /></td>
              </tr>
              <tr>
                <th scope="row"><label for="Emp">
                  <div align="right">Employee Name &nbsp;&nbsp;</div>
                </label></th>
                <td><label for="empid"></label>
                  <select name="empid" id="empid">
                   <?php
				   if(isset($_POST["submit3"]))
					{
						echo "<option value='". $resemp['empid'] . "'>" . $resemp['fname']. " ". $resemp['lname']. "</option>";
					}
					else
					{
							while($rowb = mysql_fetch_array($resultb))
							  {
							echo "<option value='". $rowb['empid'] . "'>" . $rowb['fname']. " ". $rowb['lname']. "</option>";
							  }
					}
					?>
                </select></td>
              </tr>
              <tr>
                <th scope="row"><label for="Month2">
                  <div align="right">Month and Year&nbsp;&nbsp;</div>
                </label>                </th>
                <td>
                <select name="month" id="month">
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
                  </select> &nbsp;
                  <select name="year" id="year">
                  <option value="2013">2013</option>
                  <option value="2014">2014</option>
                  <option value="2015">2015</option>
                  </select></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td><input type="submit" name="submit3" id="submit3" value="Load Salary details" /></td>
              </tr>
              <tr>
                <th scope="row"><label for="basicsalary2">
                  <div align="right">Basic Salary &nbsp;&nbsp;</div>
                </label></th>
                <td><input name="basicsalary" type="text" id="basicsalary" value="<?php echo $resemp["basicsalary"]; ?>" readonly="readonly" /></td>
              </tr>
              <?php 
			 $pfdeduction = $resemp["basicsalary"]*12/100; 
			  ?>
              <tr>
                <th scope="row"><div align="right">Bonus or if any&nbsp;&nbsp;</div></th>
                <td><input type="text" name="bonus" id="bonus" value="0" /></td>
              </tr>
              <tr>
                <th height="38" scope="row"><label for="pf2">
                  <div align="right">PF Deduction&nbsp;&nbsp;</div>
                </label></th>
                
                <td><input name="pf" type="text" id="pf" value="<?php echo $pfdeduction; ?>" readonly="readonly" /></td>
              </tr>
                      <?php 
			 $hra = $resemp["basicsalary"]*4/100; 
			  ?>
              <tr>
                <th scope="row"><div align="right">HRA&nbsp;&nbsp;</div></th>
                <td><input name="hra" type="text" id="hra" value="<?php echo $hra; ?>" readonly="readonly" /></td>
              </tr>
              <tr>
                <th scope="row">
                <div align="right">LIC  &nbsp;&nbsp;&nbsp;</div>
</th>
 			<?php 
			 $lic = $resemp["basicsalary"]*10/100; 
			  ?>
                <td><input name="lic" type="text" id="lic" value="<?php echo $lic; ?>" readonly="readonly"  /></td>
              </tr>
              <tr>
                <th height="21" scope="row"><label for="totalsalary2">
                </label></th>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th height="29" scope="row">No of working days</th>
                <td>&nbsp;<input type="text" value="<?php echo $totworkingdays = $num-$totsundays; ?>" size="10" readonly="readonly" /></td>
              </tr>
              <tr>
                <th height="29" scope="row">Attended</th>
                <td>&nbsp;<input type="text" value="<?php echo $resempt; ?>" size="10" readonly="readonly" /></td>
              </tr>
            
              <tr>
                <th height="29" scope="row">Deduction</th>
                <td>&nbsp;
                  <?php
			  $salperday = $resemp["basicsalary"] / $totworkingdays;
		 $noattday =$totworkingdays-$resempt;
		 	 $saldeduction1 = $salperday * $noattday;
			  ?>
                <input name="deduction" type="text" id="deduction" value="<?php echo $saldeduction1; ?>"  /></td>
              </tr>
              <tr>
                <th height="29" scope="row">&nbsp;</th>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th height="29" scope="row">&nbsp;</th>
                <td><input type="button" name="totalsalarya" value="Generate Salary" id="totalsalarya" onclick="myFunction()"/></td>
              </tr>
              <tr>
                <th height="46" scope="row"><div align="right">Total Salary</div></th>
                <td><input type="text" name="totalsalary" id="totalsalary" /></td>
              </tr>
              <tr>
                <th height="21" scope="row"><label for="date2">
                </label></th>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <th scope="row"><div align="right"></div></th>
                <td><input type="submit" name="submit" id="submit" value="Submit" />
                <input type="reset" name="reset" id="reset" value="Reset" /></td>
              </tr>
            </table>
       	  </form>
          <p>&nbsp;</p>
      <div class="rc_btn_02"></div>
            
            <div class="margin_bottom_40"></div>
            <div class="cleaner"></div>
        </div> <!-- end of content left -->
        
                
                <div class="margin_bottom_20">
				<?php
			 if($_SESSION["logintype"] = "Admin")
			 {
			//	include("adminsidebar.php");
			 }
			 else
			 {
				 include("empsidebar.php");
			 }
				?></div>
        	</div>
            
        </div> <!-- end of content right -->
        
        <div class="cleaner"></div>
        
    </div>
   <?php
   //include("footer.php");
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