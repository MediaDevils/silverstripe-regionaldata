<?php
class PostalCode extends DataObject {
	public static $db = array(
		"Code" => "Varchar(10)",
		"City" => "Text",
		"Latitude" => "Float",
		"Longitude" => "Float"
	);
	
	public static $has_one = array(
		"Subdivision" => "CountrySubdivision" // TODO: Map to city instead
	);
	
	public static $indexes = array(
		"CodeIndex" => array(
			"type" => "unique",
			"value" => "Code, SubdivisionID"
		)
	);
}
