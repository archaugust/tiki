<?php 
class OurLandSection extends DataObject {

	private static $db = array (
			'Title' => 'Varchar',
			'Text' => 'Text',
	);

	private static $has_one = array (
			'Photo' => 'Image',
			'ParentPage' => 'OurLandPage'
	);
	
	private static $summary_fields = array (
			'GridThumbnail' => '',
			'Title' => 'Title',
			'Text' => 'Text'
	);
	
	public function getGridThumbnail() {
		if($this->Photo()->exists()) {
			return $this->Photo()->SetWidth(100);
		}
	
		return "(no image)";
	}
	
	public function getCMSFields() {
		$fields = FieldList::create(
				TextField::create('Title'),
				TextareaField::create('Text'),
				$uploader = UploadField::create('Photo')
		);

		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));

		return $fields;
	}
}
?>