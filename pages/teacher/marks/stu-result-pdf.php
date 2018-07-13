<?php 
 
 // INCLUDE THE phpToPDF.php FILE
require("phpToPDF.php"); 

// SET YOUR PDF OPTIONS
// FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
$pdf_options = array(
  "source_type" => 'url',
  "source" => 'http://dreamservices.in/ekvira/pages/teacher/marks/stu-result.php',
  "action" => 'view',
  "save_directory" => '',
  "file_name" => 'file.pdf');

// CALL THE phptopdf FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);

// OPTIONAL - PUT A LINK TO DOWNLOAD THE PDF YOU JUST CREATED
//echo ("<a href='url_google.pdf'>Download Your PDF</a>");
    
    
    


    ?>