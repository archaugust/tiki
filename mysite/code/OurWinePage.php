<?php
class OurWinePage extends Page {
	private static $db = array(
			'Teaser' => 'HTMLText'
	);
	
	private static $has_one = array (
			'Photo' => 'Image',
			'BannerImage' => 'Image'
	);
	
	private static $has_many = array (
			'BrandTypes' => 'OurWineBrandType'
	);
	
	private static $can_be_root = false;
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $uploader1 = UploadField::create('BannerImage'), 'Content');
		$fields->addFieldToTab('Root.Main', $uploader2 = UploadField::create('Photo'), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('Teaser', 'Our Wine Page Teaser')->setRows(10), 'Content');
		$fields->addFieldToTab('Root.Labels',  GridField::create(
				'BrandTypes',
				'Brand Labels',
				$this->BrandTypes(),
				GridFieldConfig_RecordEditor::create()
		));
		
		$uploader1->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		$uploader2->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		
		return $fields;
	}

	public function Wines() {
		return OurWinePage::get();
	}
}

class OurWinePage_Controller extends Page_Controller {
	public function init() {
		parent::init();
		Requirements::javascript("{$this->Themedir()}/js/wine-page.js");
	}
}
