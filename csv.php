<?php
if (isset($_POST['csvFile']))
{
$file = $_POST['csvFile'];
csv_to_array($file,',');

function csv_to_array($filename, $delimiter)
{
	 if (($handle = fopen($filename, 'r')) === false) {
        die('Error opening file');
    }
	$headers = fgetcsv($handle, 4000, $delimiter);
    $csv2json = array();

    while ($row = fgetcsv($handle, 4000, $delimiter)) {
      $csv2json[] = array_combine($headers, $row);
    }

    fclose($handle);
   echo json_encode($csv2json); 
}

}
else 
{
  $file = null;
  echo "no file supplied";
}

?>