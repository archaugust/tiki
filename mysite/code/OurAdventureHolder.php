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
		Requirements::customCSS("
				/* mobile only css */
				figure.box figcaption {
				    top: auto;
					bottom: 0;
				    height:100px;
					padding: 20px 0;
				    opacity: 1;
				}
				figure.blog figcaption div {
					font-size: 12px;
					top: 50%;
					left: 50%;
				    transform: translate(-50%, -50%);
					-webkit-transform: translateY(-50%, -50%);
					width: 100%;
				}
				figure.box figcaption h3 {
					font-size: 24px;
					line-height: 28px;
					margin-bottom: 5px;
				}
			");
	
		Requirements::javascript("{$this->Themedir()}/js/our-adventure.js");
	}		
}