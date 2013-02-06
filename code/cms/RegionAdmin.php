<?php 

class RegionAdmin extends ModelAdmin{
	
	static $url_segment = 'regions';
	static $menu_title = 'Regions';
	
	static $managed_models = array('Country','CountrySubdivision');
	
	public static $model_importers = array(
		'Country' => 'CountriesBulkLoader',
		'CountrySubdivision' => 'CountrySubdivisionsBulkLoader'
	);
	
}
