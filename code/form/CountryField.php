<?php
class CountryField extends DropdownField {
	/**
	 * __construct
	 *
	 * @param string $name
	 * @param string $title = null
	 * @param SS_List $source = null
	 * @param string $value = ''
	 * @param Form $form = null
	 * @param string $emptyString = null
	 * @return void
	 */
	public function __construct($name, $title = null, $source = null, $value = '', $form = null, $emptyString = null) {
		if(!is_null($source) && !is_a($source, "SS_List")) {
			trigger_error("\$source must be null, or an SS_List of Country objects");
			return false;
		}
		
		if(!$source) {
			$source = Country::get();
		}
		
		$parentSource = $source->map()->toArray();
		
		parent::__construct($name, $title, $parentSource, $value, $form, $emptyString);
	}
}
