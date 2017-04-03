<?php
class OurWineHolder extends Page {

	private static $db = array (
			'Teaser' => 'HTMLText',
			'BannerText' => 'HTMLText',
			'ContentBottom' => 'HTMLText'
	);
	
	private static $has_one = array (
			'Photo' => 'Image'
	);

	private static $allowed_children = array (
			'OurWinePage'
	);
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $uploader = UploadField::create('Photo'), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('Teaser', 'Home Page Teaser')->setRows(10), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('BannerText', 'Banner Text')->setRows(10), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('ContentBottom', 'Content - After Brands'), 'Metadata');
		
		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));

		return $fields;
	}
}

class OurWineHolder_Controller extends Page_Controller {
	public function init() {
		parent::init();
		Requirements::javascript("{$this->Themedir()}/js/wine-hover.js");
	}
}