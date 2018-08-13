<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LMS</title>
</head>

<body style="margin:0; padding:0; color:#666;">

    <!--header-->
    	<div style="background:#3c8dbc; color:#fff;  padding:1px 0;">
        <div style="width:600px; margin:auto;">
       <h1 style=" font-size: 30px; margin: 20px 0; word-spacing:10px; font-family:Arial, Helvetica, sans-serif; "> <strong>CDS Lead Management System</strong></h1>
       </div>
        </div>
      <!--end-->
      <!--content-->
      <div>
      
      </div>
      <div style="width:600px; margin:auto; font-family:Arial, Helvetica, sans-serif; padding-top:15px;">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
	    <td>
        	<h3 style="margin-bottom:10px;">Dear <?php echo $name;?>,</h3>
            <p style="text-align:justify; line-height:1.4; margin-top:0;">
            Microsoft welcomes you to the CDS Lead Management System.</p>
        </td>
      </tr>
	  <tr>
	    <td>
        <!-- <h3 style="margin-bottom:10px; margin-top:8px;">Lead Management System</h3> -->
        <p style="text-align:justify; line-height:1.4; margin-top:0;">Please find your login details bellow.</p>
        <br>
        </td>
      </tr>
      <tr>
      	<td>
        	<div style="background:#f2f2f2; padding:10px; border:1px solid #ddd;">
           	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
            	  <tr>
            	    <td width="25%"><strong>Url :</strong></td>
            	    <td width="75%"><a href="<?php echo base_url();?>partner/auth">Click here to Login</a></td>

          	    </tr>
            	  <tr>
            	    <td><strong>User name :</strong></td>
            	    <td><?php echo $username;?></td>
          	    </tr>
            	  <tr>
            	    <td><strong>Password :</strong></td>
            	    <td><?php echo $password;?></td>
          	    </tr>
          	  </table>
            </div>
        </td>
      </tr>
      <tr>
	    <td>
         <h4 style="margin-bottom:7px; margin-top:30px;">Regards, </h4>
         <p style=" margin-top:0; font-size:15px;">Team CDS</p>
        </td>
      </tr>
</table>
  <!--ennd-->  
    </div>
</body>
</html>
