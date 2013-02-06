<?php
class LoadRegionalData extends BuildTask {
	public static $countries_datafile = "regionaldata/data/cdh_countries_10_29_2012.txt";
	public static $subdivisions_datafile = "regionaldata/data/cdh_subdivisions_10_29_2012.txt";
	public static $zipcodes_datafile = "regionaldata/data/zips.csv";
	public static $delete_existing_records = false;
	
	public static $transactional = true;
	
	public $title = "Load Regional Data";
	public $description = "Load or refresh the regional data schemas from their data files.";
	
	public function run($request) {
		$dbConn = DB::getConn();
		
		if(self::$transactional) $dbConn->transactionStart();
		$this->loadCountries();
		if(self::$transactional) {
			$dbConn->transactionEnd();
			$dbConn->transactionStart();
		}
		$this->loadSubdivisions();
		if(self::$transactional) {
			$dbConn->transactionEnd();
			$dbConn->transactionStart();
		}
		$this->loadPostalCodes();
		if(self::$transactional) $dbConn->transactionEnd();
	}
	
	public function loadCountries() {
		Debug::show("Loading Countries");
		$loader = new CountriesBulkLoader("Country");
		$loader->deleteExistingRecords = self::$delete_existing_records;
		$results = $loader->load(self::$countries_datafile);
		Debug::show("Loaded Countries");
	}
	
	public function loadSubdivisions() {
		Debug::show("Loading Subdivisions");
		$loader = new CountrySubdivisionsBulkLoader("CountrySubdivision");
		$loader->deleteExistingRecords = self::$delete_existing_records;
		$results = $loader->load(self::$subdivisions_datafile);
		Debug::show("Loaded Subdivisions");
	}
	
	public function loadPostalCodes() {
		Debug::show("Loading Zip Codes");
		$loader = new ZipCodeBulkLoader("PostalCode");
		$loader->deleteExistingRecords = self::$delete_existing_records;
		$results = $loader->load(self::$zipcodes_datafile);
		Debug::show("Loaded Zip Codes");
		// TODO: Other country postal codes
	}
}
