<?php
/**
 * 2nd-level administrative region of a country, as defined by ISO 3166-2 standard
 */
class CountrySubdivision extends DataObject {
	public static $db = array(
		'Name' => 'Varchar',
		'AlternativeNames' => 'Varchar',
		'ISO2' => 'Varchar(6)', //ISO 3166-2
		'Type' => "Varchar",
		'Latitude' => 'Decimal(18,12)',
		'Longitude' => 'Decimal(18,12)'
	);

	public static $has_one = array(
		'Country' => 'Country'
	);
	
	public static $summary_fields = array(
		'Country.Name',
		'Name',
		'ISO2',
		'Type'
	);
	
	public static $default_sort = "\"Type\" ASC, \"Name\" ASC";
	
	public static function get_by_country($country) {
		$countryobj = null;
		if(is_string($country)) {
			if(strlen($country) === 2) {
				$countryobj = Country::get()->filter("ISO1A2", $country)->First();
			} elseif(strlen($country) === 3) {
				$countryobj = Country::get()->filter("ISO1A3", $country)->First();
			}
		} else {
			$countryobj = $country;
		}
		if(!($countryobj instanceof Country)) {
			return null;
		}
		return self::get()->filter("CountryID", $countryobj->ID);
	}
	
	public function getShortCode() {
		list($countryCode, $divisioncode) = explode("-", $this->ISO2);
		
		return $divisioncode;
	}
}
