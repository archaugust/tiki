<?php
class OurAdventurePage extends Page {
	
	private static $db = array (
			'Date' => 'Date'
	);
	
	private static $has_one = array (
			'Photo' => 'Image'
	);
	
	private static $has_many = array (
			'SidePhotos' => 'OurAdventurePhoto'
	);
	
	private static $can_be_root = false;
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', DateField::create('Date','Date of Article')
				->setConfig('showcalendar', true), 'Content');
		$fields->addFieldToTab('Root.Main', $uploader = UploadField::create('Photo'), 'Content');
		$fields->addFieldToTab('Root.Photos',  GridField::create(
				'SidePhotos',
				'Side Photos',
				$this->SidePhotos(),
				GridFieldConfig_RecordEditor::create()
		));

		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		
		return $fields;
	}
}

class OurAdventurePage_Controller extends Page_Controller {
}
