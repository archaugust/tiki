<?php
class ContactPage extends Page {
	private static $db = array(
			'EmailRecipient' => 'Varchar'
	);
	
	private static $has_many = array (
			'Contacts' => 'Contact'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', TextField::create('EmailRecipient', 'Email Recipient'), 'Content');
		
		return $fields;
	}
}

class ContactPage_Controller extends Page_Controller {
	public function init() {
		parent::init();
		
		Requirements::javascript("{$this->Themedir()}/js/contact.js");
	}
	
	private static $allowed_actions = array (
			'ContactForm',
	);
	
	public function ContactForm() {
		$form = Form::create(
				$this,
				__FUNCTION__,
				FieldList::create(
						TextField::create('Name','')->setAttribute('placeholder', 'Name *'),
						EmailField::create('Email','')->setAttribute('placeholder', 'Email *'),
						TextField::create('Subject','')->setAttribute('placeholder', 'Subject'),
						TextareaField::create('Message','')->setAttribute('placeholder', 'Message *')
						),
				FieldList::create(
						FormAction::create('handleSubmission','Send')
						->setUseButtonTag(true)
						->setTemplate('SubmitContactRecaptcha')
						),
				RequiredFields::create('Name','Email','Message')
				);
		
		foreach ($form->Fields() as $field) {
			$field
				->addExtraClass('form-control')
				->setFieldHolderTemplate('CustomFormField_holder')
			;
		}
		
		$data = Session::get("FormData.{$form->getName()}.data");
		
		return $data ? $form->loadDataFrom($data) : $form;
	}
	
	public function handleSubmission($data, $form) {
		
		if(isset($data['g-recaptcha-response']) && !empty($data['g-recaptcha-response'])) {
			$secret = '6LczKhsUAAAAAOqsnbRtoZ-S4_u0rICrou2rW9ER';
			$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$data['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
			
			if ($response['success'] != false) {
				
				Session::set("FormData.{$form->getName()}.data", $data);
				
				$existing = Contact::get()->filter(array(
						'Message' => $data['Message']
				));
				
				if($existing->exists())
					return 'Message already sent.';
				else {
					$contact = Contact::create();
					$contact->ContactPageID = $this->ID;
					$form->saveInto($contact);
					
					$contact->write();
					
					$email = new Email();
					
					$email->setTo($this->EmailRecipient);
					$email->setFrom('noreply@tikiwine.com');
					$email->setSubject("Contact Message - ". $data['Subject']);
					
					$messageBody = '
						<p>Name: <br />'.
						$data['Name'] .'</p>
						<p>Email: <br />'.
						$data['Email'] .'</p>
						<p>Message: <br />'.
						$data['Message'] .'</p>
					';
					
					$email->setBody($messageBody);
					//				$email->send();
					
					Session::clear("FormData.{$form->getName()}.data");
					return 'Thanks for contacting us!';
				}
			}
			else
				return 'Robot verification failed, please try again.';
		}
		else
			return 'Robot verification failed, please try reloading this page.';
	}
	
}
