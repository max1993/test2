<?php
session_start();
require_once "files/scripts/connect_to_mysql.php";
if (!isset($_GET['pid'])) {
	$pageid = '1';
} else {
	$pageid = ereg_replace("[^0-9]", "", $_GET['pid']); // filter everything but numbers for security
}
$sqlCommand = "SELECT pagebody FROM pages WHERE id='$pageid' LIMIT 1";
$query = mysql_query($sqlCommand, $myConnection) or die (mysql_error());
while ($row = mysql_fetch_array($query)) { 
    $body = $row["pagebody"];
}
mysql_free_result($query); 
$sqlCommand = "SELECT modulebody FROM modules WHERE showing='1' AND name='footer' LIMIT 1"; 
$query = mysql_query($myConnection, $sqlCommand) or die (mysql_error()); 
while ($row = mysql_fetch_array($query)) { 
    $footer = $row["modulebody"];
}
mysql_free_result($query); 
$sqlCommand = "SELECT modulebody FROM modules WHERE showing='1' AND name='custom1' LIMIT 1"; 
$query = mysql_query($myConnection, $sqlCommand) or die (mysql_error()); 
while ($row = mysql_fetch_array($query)) { 
    $custom1 = $row["modulebody"];
} 
mysql_free_result($query); 
$sqlCommand = "SELECT id, linklabel FROM pages WHERE showing='1' ORDER BY id ASC"; 
$query = mysql_query($myConnection, $sqlCommand) or die (mysql_error()); 

$menuDisplay = '';
while ($row = mysql_fetch_array($query)){
  $pid = $row["id"];
  $linklabel = $row["linklabel"];	
	$menuDisplay .= '<a href="index.php?pid=' . $pid . '">' . $linklabel . '</a><br />';	
} 
mysql_free_result($query); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Website</title>
<link rel="stylesheet" href="files/style/main.css">
</head>
<body>
<table width="888" border="0" align="center" cellpadding="6">
  <tr>
    <td align="center"><table width="100%" border="0" cellpadding="8">
      <tr>
        <td colspan="2"><table width="100%" border="0">
          <tr>
            <td width="46%"><a href="index.php"><img src="files/style/logo.png" alt="My Magic Site Logo" width="360" height="80" border="0" /></a></td>
            <td width="54%" valign="top" bgcolor="#150D00"><?php echo $custom1; ?></td>
          </tr>
        </table>
      </td>
        </tr>
      <tr>
        <td width="22%" valign="top" bgcolor="#150D00" style="border:#6B450C thin solid; line-height:1.5em;">
		<?php echo $menuDisplay; ?>
          </td>
        <td width="78%" valign="top" bgcolor="#150D00" style="border:#6B450C thin solid;">
        <div style="width:656px; height:400px; overflow: auto;"><?php echo $body; ?></div>          
        </td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#150D00" style="border:#6B450C thin solid;"><?php echo $footer; ?></td>
        </tr>
    </table>
    &copy;Copyright 2009 Developphp.com</td>
  </tr>
</table>
<div align="center"><a href="administrator">Admin</a></div><br />
</body>
</html>