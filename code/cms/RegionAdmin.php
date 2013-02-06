<?php 
class RegionAdmin extends ModelAdmin {
	public static $url_segment = 'regions';
	public static $menu_title = 'Regions';
	
	public static $managed_models = array(
		'Country',
		'CountrySubdivision',
		'PostalCode'
	);
	
	public static $model_importers = array(
		'Country' => 'CountriesBulkLoader',
		'CountrySubdivision' => 'CountrySubdivisionsBulkLoader'
	);
	
}
