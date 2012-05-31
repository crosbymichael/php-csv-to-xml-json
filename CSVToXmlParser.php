<?php

include_once("CSVParserBase.php");

/**
 * Specific implementation to parse csv to an xml document
 */
class CSVToXmlParser extends CSVParserBase {
	public $ItemName = 'item';

	protected function ProcessArray($array) {
		$startingIndex = 0;
		$document = '';

		if ($this->IsFirstRowHeader) {
			$startingIndex = 1;
			$this->HeaderArray = $array[0];
		}

		$columnCount = count($array[0]);

		$document = "<?xml version=\"1.0\" ?>\n";
		$document .= "<root>\n";

		for ($i=$startingIndex; $i < count($array); $i++) { 
			$document .= $this->GetItemName();

			for ($n=0; $n < $columnCount; $n++) { 
				$columnName = $this->GetColumnName($n);

				$document .= sprintf(
					"\t\t<%s>%s</%s>\n",
					$columnName,
					$array[$i][$n],
					$columnName);
			}

			$document .= $this->GetItemName(true);
		}

		$document .= "</root>";

		return $document;
	}

	private function GetColumnName($index) {
		$name = 'column' . $index;

		if ($this->HeaderArray != null && 
			count($this->HeaderArray) > 0) 
		{
			$name = $this->StripString(
				$this->HeaderArray[$index]);
		}
		return $name;
	}

	private function GetItemName($close = false) {
		$format = ($close) ? "\t</%s>\n" : "\t<%s>\n";
		return sprintf($format, $this->ItemName);
	}
}