<?php
class ZipCodeBulkLoader extends CsvBulkLoader {
	public $columnMap = array(
		"zip code" => "Code",
		"state abbreviation" => "StateAbbrev",
		"city" => "City",
		"latitude" => "Latitude",
		"longitude" => "Longitude"
	);
	
	public $duplicateChecks = array(
		"zip code" => "Code"
	);
	
	public $relationCallbacks = array(
		"StateAbbrev" => array(
			"relationname" => "Subdivision",
			"callback" => "StateByISOA2"
		)
	);
	
	public function StateByISOA2($obj, $val, $record) {
		return CountrySubdivision::get()->filter(array(
			"ISO2" => "US-{$val}"
		))->First();
	}
}
