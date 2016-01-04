#!/usr/bin/php -q
<?php

# needed path /usr/lib/php/
echo get_include_path();
var_dump(ini_get('include_path'));


include 'PHPExcel/PHPExcel/Reader/Excel2007.php';
$objReader = new PHPExcel_Reader_Excel2007;
//var_dump($objReader);
$objPHPExcel = $objReader->load('Volby_NRSR_2002_2012/2012_Platne_hlasy_podla_obci.xls');

//var_dump($objPHPExcel);
echo $objPHPExcel->getSheetCount();


