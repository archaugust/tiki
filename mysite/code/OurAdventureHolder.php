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
	
}