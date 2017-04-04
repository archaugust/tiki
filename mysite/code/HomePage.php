<?php
class HomePage extends Page {
	private static $db = array (
			'BannerText' => 'HTMLText',
			'VideoEmbedCode' => 'HTMLText',
			'InstagramUserID' => 'Varchar',
			'InstagramAccessToken' => 'Varchar(60)',
			'SubIntro' => 'HTMLText'
	);
	
	private static $has_one = array(
			'Photo' => 'Image'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $uploader = UploadField::create('Photo', 'Banner Image'), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('BannerText', 'Banner Text')->setRows(10), 'Content');
		$fields->addFieldToTab('Root.Main', HtmlEditorField::create('SubIntro', 'Sub Intro Text')->setRows(10), 'Metadata');
		$fields->addFieldToTab('Root.Main', TextareaField::create('VideoEmbedCode', 'Video Embed HTML'), 'Metadata');
		$fields->addFieldToTab('Root.Main', TextField::create('InstagramAccessToken', 'Instagram Access Token'), 'Metadata');
		$fields->addFieldToTab('Root.Main', TextField::create('InstagramUserID', 'Instagram User ID'), 'Metadata');
		
		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));
		
		return $fields;
	}
}

class HomePage_Controller extends Page_Controller {
	public function init() {
		parent::init();

		if (preg_match("/\b(?:a(?:ndroid|vantgo)|b(?:lackberry|olt|o?ost)|cricket|do‌​como|hiptop|i(?:emob‌​ile|p[ao]d)|kitkat|m‌​(?:ini|obi)|palm|(?:‌​i|smart|windows )phone|symbian|up\.(?:browser|link)|tablet(?: browser| pc)|(?:hp-|rim |sony )tablet|w(?:ebos|indows ce|os))/i", $_SERVER["HTTP_USER_AGENT"]) == true)
			Requirements::customCSS('
				/* mobile only css */
				figure.box:hover figcaption {
					display:none;
				}
			');
			
		Requirements::javascript("{$this->Themedir()}/js/home-page.js");
		Requirements::customScript(<<<JS
		    var feed = new Instafeed({
		        get: 'user',
		        userId: '$this->InstagramUserID',
				accessToken: '$this->InstagramAccessToken',
				resolution: 'standard_resolution',
				limit: 8,
				after: mobileTap,
		        template: '<div><figure class="box"><img src="{{image}}" /><a href="{{link}}" target="_blank"><figcaption>{{caption}}</figcaption></a></figure></div>'
		    });
		    feed.run();
JS
		);
	}
	
	public function index(SS_HTTPRequest $request) {
		
		$pages = SiteTree::get()->filter(array('ShowInSearch' => 1, 'ParentID' => 0));
		
		return array(
				'Pages' => $pages
		);
	}
}
