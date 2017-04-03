<?php 
class OurStoryPhoto extends DataObject {

	private static $db = array(
			'Caption' => 'Text'
	);
	
	private static $has_one = array (
			'Photo' => 'Image',
			'ParentPage' => 'OurStoryPage'
	);
	
	private static $summary_fields = array (
			'GridThumbnail' => '',
	);
	
	public function getGridThumbnail() {
		if($this->Photo()->exists()) {
			return $this->Photo()->SetWidth(100);
		}
	
		return "(no image)";
	}
	
	public function getCMSFields() {
		$fields = FieldList::create(
				TextareaField::create('Caption'),
				$uploader = UploadField::create('Photo')
		);
		
		$uploader->getValidator()->setAllowedExtensions(array('png','gif','jpeg','jpg'));

		return $fields;
	}
}
?>