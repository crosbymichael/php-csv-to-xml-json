<?php
//Average CSV to XML performance 1.32sec for 3493 rows
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
		
		$arrayHeader = count($cArray[0]); //Get number of columns in array
		
		echo "<?xml version=\"1.0\" ?>\n<item>\n"; //XML header and Opening tag
		
		//Iterate over length of rows
		for ($i = 0; $i < count($cArray); $i++)
		{
			echo "<items>\n"; //Opening items tag
			//Iterate over length the columns.
			for ($n = 0; $n < $arrayHeader; $n++)
			{
				//echo "<column$n>" . $cArray[$i][$n] . "</column$n>";
				//It is actually faster to do 7 echos than the one line above, on average
				echo "<column";
				echo $n;
				echo ">";
				echo $cArray[$i][$n];
				echo "</column";
				echo $n;
				echo ">"; 
			}
			echo "</items>\n"; //Closing items tag
		}
			echo "</item>"; //Closing tag
		
		}
} 

?>


