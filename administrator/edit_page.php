<?php 
session_start();
/* Created by Adam Khoury @ www.developphp.com */
include_once "admin_check.php";
?>
<?php 
// You should put an if condition here to check that the posted $pid variable is present first thing, I did not do that
$pid = ereg_replace("[^0-9]", "", $_POST['pid']); // filter everything but numbers for security
// Query the body section for the proper page
include_once "../scripts/connect_to_mysql.php";
$sqlCommand = "SELECT pagetitle, linklabel, pagebody FROM pages WHERE id='$pid' LIMIT 1"; 
$query = mysqli_query($myConnection, $sqlCommand) or die (mysqli_error()); 
while ($row = mysqli_fetch_array($query)) { 
    $pagetitle = $row["pagetitle"];
	$linklabel = $row["linklabel"];
	$pagebody = $row["pagebody"];
	$pagebody = str_replace("<br />", "", $pagebody);
} 
mysqli_free_result($query); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editing Page</title>
<script type="text/javascript">

function validate_form ( ) { 
    valid = true;
    if ( document.form.pagetitle.value == "" ) { 
	alert ( "Please enter the page title." ); 
	valid = false;
	} else if ( document.form.linklabel.value == "" ) { 
	alert ( "Please enter info for the link label." ); 
	valid = false;
	} else if ( document.form.pagebody.value == "" ) { 
	alert ( "Please enter some info into the page body." ); 
	valid = false;
	}
	return valid;
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
}
-->
</style></head>

<body>
<table width="100%" border="0" cellpadding="8">
  <tr>
    <td><h3>Editing Existing Page&nbsp;&nbsp;&bull;&nbsp;&nbsp; <a href="index.php">Admin Home</a> &nbsp;&nbsp;&bull;&nbsp;&nbsp;<a href="../" target="_blank">View Live Website</a></h3></td>
  </tr>
  <tr>
    <td><?php echo $error_message; ?><br /></td>
  </tr>
  <tr>
    <td>
    
<table width="100%" border="0" cellpadding="5">
    <form id="form" name="form" method="post" action="page_edit_parse.php"  onsubmit="return validate_form ( );">
  <tr>
    <td width="12%" align="right" bgcolor="#F5E4A9">Page Full Title</td>
    <td width="88%" bgcolor="#F5E4A9"><input name="pagetitle" type="text" id="pagetitle" size="80" maxlength="64" value="<?php echo $pagetitle; ?>" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#D7EECC">Link Label</td>
    <td bgcolor="#D7EECC"><input name="linklabel" type="text" id="linklabel" maxlength="24"  value="<?php echo $linklabel; ?>" /> 
      (What the link to this page will display as)</td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#DAEAFA">Page Body</td>
    <td bgcolor="#DAEAFA"><textarea name="pagebody" id="pagebody" cols="88" rows="16"><?php echo $pagebody; ?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
    <input name="pid" type="hidden" value="<?php echo $pid; ?>" />
    <input type="submit" name="button" id="button" value="Submit Page Edit" /></td>
  </tr>
  </form>
</table>

    
    </td>
  </tr>
</table>
</body>
</html>