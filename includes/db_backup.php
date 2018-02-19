<?php	
$iniUrl = '../';
include($iniUrl . 'header.php');
include_once 'psl-config.php';

$backup = backup_tables(HOST, USER, PASSWORD, DATABASE);

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Backup <small>Base de Datos</small></h1>
    </section>

    <!-- Main content -->
    <section class="content">

				<div class="col-md-12">
					<?php if ($backup) { ?>
					<div class="callout callout-success">
						<i class="fa fa-check"></i> &nbsp; <strong>El Backup ha sido enviado correctamente...</strong>
					</div>
					<?php } else { ?>
					<div class="callout callout-danger">
						<i class="fa fa-remove"></i> &nbsp; <strong>No ha sido posible enviar el archivo...</strong>
					</div>
					<?php } ?>

				</div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
	
<?php

include($iniUrl . 'footer.php');

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*') {
	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		// $return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$archivo = 'db-backup-'.date('Y-m-d_H-i').'.sql'; // (md5(implode(',',$tables))). 
	$handle = fopen( $archivo,'w+');
	fwrite($handle,$return);
	fclose($handle);
	
	// -------- Mail
	/*
	$mailto = 'luisfavre@gmail.com';
	$from_mail = 'info@19doce.com.ar';
	$from_name = 'Zarate Backup';
	$replyto = 'info@19doce.com.ar';
	$subject = 'Respaldo de Databases Zarate';
	$message = 'El backup ha sido exitoso... Kave rules!';

	$file = $archivo;
	$filename = $archivo;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
		
    if (mail($mailto, $subject, $message, $header)) {
        return true;
    } else {
        return false;
    } */
		
/* Email Detials */
  $mail_to = "luisfavre@gmail.com";
  $from_mail = "info@19doce.com.ar";
  $from_name = "Zarate Backup";
  $reply_to = "info@19doce.com.ar";
  $subject = "Backup";
  $message = "Enviado";
 
/* Attachment File */
  // Attachment location
  $file_name = $archivo;
  $path = "";
   
  // Read the file content
  $file = $path.$file_name;
  $file_size = filesize($file);
  $handle = fopen($file, "r");
  $content = fread($handle, $file_size);
  fclose($handle);
  $content = chunk_split(base64_encode($content));
   
/* Set the email header */
  // Generate a boundary
  $boundary = md5(uniqid(time()));
   
  // Email header
  $header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
  $header .= "Reply-To: ".$reply_to.PHP_EOL;
  $header .= "MIME-Version: 1.0".PHP_EOL;
   
  // Multipart wraps the Email Content and Attachment
  $header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
  $header .= "This is a multi-part message in MIME format.".PHP_EOL;
  $header .= "--".$boundary.PHP_EOL;
   
  // Email content
  // Content-type can be text/plain or text/html
  $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
  $header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
  $header .= "$message".PHP_EOL;
  $header .= "--".$boundary.PHP_EOL;
   
  // Attachment
  // Edit content type for different file extensions
  $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
  $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
  $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
  $header .= $content.PHP_EOL;
  $header .= "--".$boundary."--";
   
  // Send email
  if (mail($mail_to, $subject, "", $header)) {
    return true;
  } else {
    return false;
  }		
};
?>
