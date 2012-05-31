License:
---

Copyright (c) 2011 Michael Crosby crosbymichael.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

##Updated v2.0 - OOP..ify..ing..it

For this version I converted the files into classes with a factory to provide the correct implementations.  


By using the static factory provided you only need one include in your consuming code.


	include_once("CSVParser.php");


Here is the updated usage for the results.

	<?php

	//This is an example how to use the new class interface

	include_once("CSVParser.php");

	//Use the factory to get the correct parser
	// "json" or "xml" as input
	$jsonParser = CSVParserFactory::Create("json");
	$xmlParser = CSVParserFactory::Create("xml", 1000, ',');

	//Url for file path, whatever you want
	$path = "http://ichart.finance.yahoo.com/table.csv?s=GOOG&d=6&e=17&f=2011&g=d&a=7&b=19&c=2004&ignore=.csv";

	//This property will use the first row to convert the results into a 
	//json object array
	$jsonParser->IsFirstRowHeader = true;
	$json = $jsonParser->Parse($path);

	//Set this property to use the first row as the column names
	//and ommit the first row from the results
	$xmlParser->IsFirstRowHeader = true;

	//Set the custom item name
	$xmlParser->ItemName = "customItem";
	$xml = $xmlParser->Parse($path);

	echo $json;

	/*
		Json Result 
	  {
	    "Date":"2004-08-19",
	    "Open":"100.00",
	    "High":"104.06",
	    "Low":"95.96",
	    "Close":"100.34",
	    "Volume":"22351900",
	    "Adj Close":"100.34"
	  }

	 */
	echo "\n\n\n";

	/*
		XML Result

		<?xml version="1.0" ?>
	<root>
		<customItem>
			<Date>2011-07-15</Date>
			<Open>597.50</Open>
			<High>600.25</High>
			<Low>588.16</Low>
			<Close>597.62</Close>
			<Volume>13732100</Volume>
			<AdjClose>597.62</AdjClose>
		</customItem>
	*/
	//echo $xml;

	?>


If you want the old implementation just go back in the history of the repository.  
