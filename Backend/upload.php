<?php

if(isset($_FILES['upload']['name'])){

 $file = $_FILES['upload']['tmp_name'];

 $file_name = $_FILES['upload']['name'];

 $file_name_array = explode(".", $file_name);

 $extension = end($file_name_array);

 $new_image_name = rand() . '.' . $extension;

 chmod('upload', 0777);

 $allowed_extension = array("jpg", "gif", "png");

 if(in_array($extension, $allowed_extension))

 {

  move_uploaded_file($file, 'upload/' . $new_image_name);

  $function_number = $_GET['CKEditorFuncNum'];

  $url = 'upload/' . $new_image_name;

  $message = '';

  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";

 }

}

?>
<?php 	
  if(isset($_FILES["file"])){
    $uploadFolder="dokumen/";
    $fileName=basename($_FILES["file"]["name"]); #Get File Name 
    $fileType=pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);#Get File Extension
    $fileType=strtolower($fileType); #convert to lowercase
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'csv', 'mp3','mp4'); 
    if(in_array($fileType,$allowTypes)){
      #Move file into 'upload' Folder
      if(move_uploaded_file($_FILES["file"]["tmp_name"],$uploadFolder.$fileName)){
        echo "<div class='alert alert-success'><b>$fileName</b> Upload Successfully</div>";
      }else{
        echo "<div class='alert alert-danger'><b>$fileName</b> Upload Failed. Try Again.</div>";
      }
    }else{
      echo "<div class='alert alert-danger'>Upload Failed. <b>$fileType</b> Not allowed.</div>";
    }
  }
?>
