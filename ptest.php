<?php
$file = "bootstrap/cache";
if(is_dir($file))
  {
      chmod($file, 0777);
  echo ("$file is a directory");
  }
else
  {
  echo ("$file is not a directory");
  }
?>

    