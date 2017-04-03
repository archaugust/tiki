<?php
class OurLandPage extends Page {
	private static $db = array (
			'Teaser' => 'HTMLText'
	);
	
	private static $has_one = array (
			'Photo' => 'Image'
	);
	
	private static $has_many = array (
			'Sections' => 'OurLandSection'
	);
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $uploader = UploadField::create('Photo', 'Banner Image'), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('Teaser', 'Home Page Teaser')->setRows(10), 'Content');
		$fields->addFieldToTab('Root.Sections', GridField::create(
				'Sections',
				'Page Sections',
				$this->Sections(),
				GridFieldConfig_RecordEditor::create()
		));
		
		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		
		return $fields;
	}
}

class OurLandPage_Controller extends Page_Controller {
	public function init() {
		parent::init();
		
		Requirements::javascript("{$this->Themedir()}/js/our-land.js");
	}
	
}
