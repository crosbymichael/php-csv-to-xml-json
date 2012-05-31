<?php

/**
 * Abstract base class that provides a common interface for the parser
 * along with shared methods and properties.
 */
abstract class CSVParserBase {
	protected $MaxLenght = 0;
	protected $Separator = '';
	
	public $HeaderArray = null;
	public $IsFirstRowHeader = false;
	
	function __construct($maxLenght = 1000, $separator = ',') {
		$this->MaxLenght = $maxLenght;
		$this->Separator = $separator;
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

	protected function StripString($contents) {
		return preg_replace(
				'/\s+/', 
				'', 
				$contents);;
	}
}
