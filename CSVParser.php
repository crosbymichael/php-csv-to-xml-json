<?php

class CSVParserFactory {
	
	public static function Create($type) {
		switch ($type) {
			case 'json':
				return new CSVToJsonParser();
			case 'xml':
				return new CSVToXmlParser();
		}
	}
}

abstract class CSVParser {
	protected $MaxLenght = 0;
	protected $Separator = '';
	
	function __construct($maxLenght = 1000, $separater = ',') {
		$this->MaxLenght = $maxLenght;
		$this->Separator = $separater;
	}
	
	public function Parse($csvData) {
		$array = null;
		
		if (($fh = fopen($csvData, "r"))) {
			while (($data = fgetcsv($fh, $this->MaxLenght, $this->Separator))) {
				$array[] = $data;
			}
			fclose($fh);
		} else {
			throw new Exception("Cannot parse data", 1);
		}
		
		return $this->ProcessArray($array);
	}
	
	protected abstract function ProcessArray($array);
}


class CSVToJsonParser extends CSVParser {
		
	protected function ProcessArray($array) {
		return json_encode($array);
	}
	
}

class CSVToXmlParser extends CSVParser {
	 
	protected function ProcessArray($array) {
		
	}
}

?>