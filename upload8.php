<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $uploadOk = 1;
}

function csv_to_array($filename, $delimiter)
{
	 if (($handle = fopen($filename, 'r')) === false) {
		
        die('Error opening file');
    }
	$headers = fgetcsv($handle, 4000, $delimiter);
    foreach($headers as $upperHeader)
	{
	  $headerFinal[] = strtoupper($upperHeader);
	}
	
    $csv2json = array();

    while ($row = fgetcsv($handle, 4000, $delimiter)) {
      $csv2json[] = array_combine($headerFinal, $row);
    }

    fclose($handle);
   $studentList = json_encode($csv2json); 
  $fullList = json_decode($studentList);
  
  foreach($fullList as $fList)
  {
	  var_dump($fList);
  //eztexting section
  $mobileNumber = $fList->MOBILENUMBER;
  $phoneNumber = $fList->PHONE;
  $workNumber = $fList->WORKPHONE;
  $otherNumber = $fList->OTHERPHONE;

  
  if($mobileNumber == "" || $mobileNumber == NULL)
  {
	if($otherNumber == "" || $otherNumber == NULL)
	{
		if($workNumber == "" || $workNumber == NULL)
		{
			if($phoneNumber == "" || $phoneNumber == NULL)
			{
				echo("No Number Attached");
			}
			else
			{
				$cellNumber = $phoneNumber;
			}
		}
		else
		{
			$cellNumber = $workNumber;
		}
	}
	else
	{
		$cellNumber = $otherNumber;
	}
  }
  else
  {
	  $cellNumber = $mobileNumber;
  }
  $phone = preg_replace('/\D+/', '', $cellNumber);
  
  
  $data = array(
    'User'          => 'tci',
    'Password'      => 'Tciez1',
    'PhoneNumbers'  => $phone,
    'Subject'       => $_POST['subjectinput'],
    'Message'       => "Dear " . $fList->FIRSTNAME . " " . $fList->LASTNAME . ", " .$_POST['messages'] . " " . $_POST['xtramsg'],
    'MessageTypeID' => 1
);

$curl = curl_init('https://app.eztexting.com/sending/messages?format=json');
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// If you experience SSL issues, perhaps due to an outdated SSL cert
// on your own server, try uncommenting the line below
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
curl_close($curl);

$json = json_decode($response);
$json = $json->Response;

if ( 'Failure' == $json->Status ) {
    $errors = array();
    if ( !empty($json->Errors) ) {
        $errors = $json->Errors;
    }

    echo 'Status: ' . $json->Status . "\n" .
         'Errors From Extexting: ' . implode(', ' , $errors) . "\n";
} else {
    $phoneNumbers = array();
    if ( !empty($json->Entry->PhoneNumbers) ) {
        $phoneNumbers = $json->Entry->PhoneNumbers;
    }

    $localOptOuts = array();
    if ( !empty($json->Entry->LocalOptOuts) ) {
        $localOptOuts = $json->Entry->LocalOptOuts;
    }

    $globalOptOuts = array();
    if ( !empty($json->Entry->GlobalOptOuts) ) {
        $globalOptOuts = $json->Entry->GlobalOptOuts;
    }

    $groups = array();
    if ( !empty($json->Entry->Groups) ) {
        $groups = $json->Entry->Groups;
    }

    echo 'Status: ' . $json->Status . "\n" .
         'Message ID : ' . $json->Entry->ID . "\n" .
         'Subject: ' . $json->Entry->Subject . "\n" .
         'Message: ' . $json->Entry->Message . "\n" .
         'Message Type ID: ' . $json->Entry->MessageTypeID . "\n" .
         'Total Recipients: ' . $json->Entry->RecipientsCount . "\n" .
         'Credits Charged: ' . $json->Entry->Credits . "\n" .
         'Time To Send: ' . $json->Entry->StampToSend . "\n" .
         'Phone Numbers: ' . implode(', ' , $phoneNumbers) . "\n" .
         'Groups: ' . implode(', ' , $groups) . "\n" .
         'Locally Opted Out Numbers: ' . implode(', ' , $localOptOuts) . "\n" .
         'Globally Opted Out Numbers: ' . implode(', ' , $globalOptOuts) . "\n";
}
  
}
  
}
// Check if file already exists
if (file_exists($target_file)) {
	unlink($target_file);
    echo "Overwritting existing file.";
    $uploadOk = 1;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
&& $fileType != "gif" && $fileType != "csv" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $file = "http://localhost/smsApp/" .$target_file;
csv_to_array($file,",");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
