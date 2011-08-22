<?php
//Average CSV to JSON performance 1.15sec for 3493 rows
//Michael Crosby crosbymichael.com

//Uses "," by default but user can specify a different separater.
$sep = $_GET['sep'];
//Max lenght of line in the csv
$maxLenght = 1000;

 //Using different letters for the separators
 switch($sep)
 {
        case "c": //comma
	        $fieldsep = ",";
	        break;
        case "fs":  //forward slash
	        $fieldsep = "/";
	        break;
        case "bs":  //back slash
	        $fieldsep = "'\'";
	        break;
        case "s": //space
	        $fieldsep = " ";
	        break;
        default: //default comma
	        $fieldsep = ",";
	        break; 
 }

//Call function
parseCSV();


function parseCSV()
{
	global $fieldsep, $maxLength;
	
	//Get the url of the csv file to parse.
	$csvurl = $_GET['url'];
	
	//Make sure there is a url passed
	if ($csvurl == "")
	{
		echo "Not valid url.";
		return;
	}
	else
	{
		if (($fileOpen = fopen($csvurl, "r"))) 
		{
			while (($data = fgetcsv($fileOpen, $maxLength, $fieldsep))) 
			{
				$cArray[] = $data; //Add csv data to array
			}
			//Close file
			fclose($fileOpen);
		}
		else
		{
			echo "Cannot open file.";
			return;
		}

		echo json_encode($cArray); //That was easy
	}		
} 

?>


