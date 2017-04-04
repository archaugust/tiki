<?php
class OurAdventureHolder extends Page {

	private static $db = array (
			'Teaser' => 'HTMLText'
	);
	
	private static $has_one = array (
			'Photo' => 'Image'
	);

	private static $allowed_children = array (
			'OurAdventurePage'
	);
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $uploader = UploadField::create('Photo'), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('Teaser', 'Home Page Teaser')->setRows(10), 'Content');
		
		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		
		return $fields;
	}
}

class OurAdventureHolder_Controller extends Page_Controller {

	public function init() {
		parent::init();
		
		if (preg_match("/\b(?:a(?:ndroid|vantgo)|b(?:lackberry|olt|o?ost)|cricket|do‌​como|hiptop|i(?:emob‌​ile|p[ao]d)|kitkat|m‌​(?:ini|obi)|palm|(?:‌​i|smart|windows )phone|symbian|up\.(?:browser|link)|tablet(?: browser| pc)|(?:hp-|rim |sony )tablet|w(?:ebos|indows ce|os))/i", $_SERVER["HTTP_USER_AGENT"]) == true)
		Requirements::customCSS('
				/* mobile only css */
				figure.box:hover figcaption {
					display:none;
				}
			');
	
		Requirements::javascript("{$this->Themedir()}/js/our-adventure.js");
	}		
}