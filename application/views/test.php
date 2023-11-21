<?php

echo "Print Report Test"; 
$my_report = "D:\\CR\\rincian.rpt";
$my_pdf = "D:\\CR\\komen.pdf"; // RPT export to pdf file 
$ObjectFactory= new COM("CrystalRuntime.Application.8.5") or die ("Error on load"); 
$creport = $ObjectFactory->OpenReport($my_report, 1)

?>