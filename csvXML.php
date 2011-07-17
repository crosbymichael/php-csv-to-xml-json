<!--Copyright (c) 2011 Michael Crosby crosbymichael.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
<?php
//Average CSV to XML performance 1.32sec for 3493 rows


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


