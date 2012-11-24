<?php
header("Content-Disposition: Attachment;filename=pdf.zip"); 
header("Content-Type:  application/octet-stream");
echo file_get_contents('pdf.zip');
die;
?>
