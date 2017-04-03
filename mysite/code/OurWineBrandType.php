<?php 
class OurWineBrandType extends DataObject {

	private static $db = array (
			'Title' => 'Varchar',
			'SubTitle' => 'Varchar',
			'Text' => 'HTMLText'
	);

	private static $has_one = array (
			'Photo' => 'Image',
			'ParentWineBrand' => 'OurWinePage'
	);
	
	private static $summary_fields = array (
			'GridThumbnail' => '',
			'Title' => 'Title',
			'SubTitle' => 'SubTitle',
			'Text' => 'Text'
	);
	
	static $singular_name = "Brand Label";
	static $plural_name = "Brand Labels";
	
	public function getGridThumbnail() {
		if($this->Photo()->exists()) {
			return $this->Photo()->SetWidth(100);
		}
	
		return "(no image)";
	}
	
	public function getCMSFields() {
		$fields = FieldList::create(
				TextField::create('Title'),
				TextField::create('SubTitle'),
				HtmlEditorField::create('Text'),
				$uploader = UploadField::create('Photo')
		);

		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));

		return $fields;
	}
}
?>