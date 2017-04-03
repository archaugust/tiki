<?php
class OurStoryPage extends Page {

	private static $db = array (
			'Teaser' => 'HTMLText',
			'ContentTop' => 'HTMLText',
			'ContentBottom' => 'HTMLText'
	);
	
	private static $has_one = array (
			'Photo' => 'Image'
	);

	private static $has_many = array (
			'SlidePhotos' => 'OurStoryPhoto'
	);
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $uploader = UploadField::create('Photo'), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('Teaser', 'Home Page Teaser')->setRows(10), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('ContentTop', 'Content - Before Slideshow'), 'Metadata');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('ContentBottom', 'Content - After Slideshow'), 'Metadata');
		$fields->addFieldToTab('Root.SlideshowPhotos',  GridField::create(
				'SlidePhotos',
				'Slideshow Photos',
				$this->SlidePhotos(),
				GridFieldConfig_RecordEditor::create()
				));

		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		
		return $fields;
	}
}

class OurStoryPage_Controller extends Page_Controller {
	
}