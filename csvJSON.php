<!--Copyright (c) 2011 Michael Crosby crosbymichael.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
<?php
//Average CSV to JSON performance 1.15sec for 3493 rows


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


