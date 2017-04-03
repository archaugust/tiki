<?php 
class Subscriber extends DataObject {

	private static $db = array (
			'Name' => 'Varchar',
			'Email' => 'Varchar',
	);

	private static $summary_fields = array (
			'Name' => 'Name',
			'Email' => 'Email'
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(
				TextField::create('Name'),
				EmailField::create('Email')
		);

		return $fields;
	}
}
?>