<?php

include_once("CSVParserBase.php");

/**
 * Specific implementation to parse a csv document into json
 */
class CSVToJsonParser extends CSVParserBase {
	
	protected function ProcessArray($array) {
		
		if ($this->IsFirstRowHeader) {
			$this->HeaderArray = $array[0];
			$array = $this->ToAssocativeArray($array);
		}

		return json_encode($array);
	}
	
	private function ToAssocativeArray($array) {

		$columnCount = count($array[0]);
		$temp = array();

		for ($i=1; $i < count($array); $i++) { 
			$item = array();
			
			for ($n=0; $n < $columnCount; $n++) { 
				$columnName = $this->HeaderArray[$n];
				$item[$columnName] = $array[$i][$n];	
			}

			$temp[] = $item;
			$item = null;
		}
		return $temp;
	}
}