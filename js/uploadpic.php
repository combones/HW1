<?php
if(isset($_POST["submit"])){
  
$target_dir = "./uploads";
$target_file = $target_dir . basename($_FILES["myFile"]["name"]);
$uploadOk = 1;


$ftp_server = "10.1.3.40";
$ftp_conn = ftp_connect($ftp_server);
$login = ftp_login($ftp_conn, '58102010829', '58102010829');

$file = $_FILES["myFile"]["tmp_name"];

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

 chmod ( $_FILES["myFile"]["tmp_name"] , 777 );
 
 ftp_pasv($ftp_conn, true);
 
 ftp_chdir($ftp_conn,'uploads/');
//if (ftp_put($ftp_conn, "serverfile.jpg", $file,FTP_BINARY  ))

$remoteFname = preg_replace('"\.tmp$"', '.jpg',basename($_FILES["myFile"]["tmp_name"]));

if (ftp_put($ftp_conn, $remoteFname,$file,FTP_BINARY  )) {
    $url = '"url":"http://10.1.3.40/58102010829/uploads/' . $remoteFname . '"';
	$pic = "http://10.1.3.40/58102010829/uploads/" . $remoteFname;
    if ($isEdit == false) {

        echo '{"edit":false,"success":true,' . $url . '}';


    }else{
        echo '{"edit":true,"success":true,' . $url . '}';
    }
}
else
  {
  echo '{"edit":true,"success":false}';
  }
}
?>
<html>
<head></head>
<form action="" enctype="multipart/form-data" method="POST">
<input type="file" name="myFile" id="myFile"  />
<input name="submit" type="submit" value="Upload File" />
<?php echo "<img src=" . $pic . " width=20"height="20/>"; ?>
</form>
</html>