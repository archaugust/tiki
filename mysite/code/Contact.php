<?php 
class Contact extends DataObject {

	private static $db = array (
			'Name' => 'Varchar',
			'Email' => 'Varchar',
			'Subject' => 'Varchar(160)',
			'Message' => 'Text'
	);

	private static $has_one = array (
			'ContactPage' => 'ContactPage'
	);
	
	private static $summary_fields = array (
			'Name' => 'Name',
			'Email' => 'Email',
			'Subject' => 'Subject',
			'Message' => 'Message'
	);
	
	public function getCMSFields() {
		$fields = FieldList::create(
				TextField::create('Name'),
				TextField::create('Email'),
				TextField::create('Subject'),
				TextareaField::create('Message')
		);
		return $fields;
	}
}
?>