<?php
class Page extends SiteTree {

	public function EncryptedEmail() {
		$email = ContactPage::get()->first()->EmailRecipient;
		
		$character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';
		$key = str_shuffle($character_set); $cipher_text = '';
		
		for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];
		
		$script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';
		$script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';
		$script.= '$(".email").html("<a href=\\"mailto:"+d+"\\">"+d+"</a>")';
		$script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")";
		$script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';
		
		return new ArrayData(array(
			'Tag' => '<span class="email">[javascript protected email address]</span>',
			'Script' => $script 
		));
	}
}
class Page_Controller extends ContentController {
	
	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
			'SubscribeForm',
	);
	
	public function init() {
		parent::init();
		
		Requirements::css("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800");
		Requirements::css("{$this->ThemeDir()}/css/bootstrap.min.css");
		Requirements::css("{$this->Themedir()}/css/animation.css");
		Requirements::css("{$this->Themedir()}/css/animate.css");
		Requirements::css("{$this->Themedir()}/css/fontello.css");
		Requirements::css("{$this->Themedir()}/css/style.css");
		
		Requirements::javascript("https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js");
		Requirements::javascript("https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit", true, true);
		Requirements::javascript("{$this->Themedir()}/js/bootstrap.min.js");
		Requirements::javascript("{$this->Themedir()}/js/custom.js");
	}
	
	public function SubscribeForm() {
		Session::set('subscribed',false);
		$subscribed = Session::get('subscribed');
		
		$form = Form::create(
			$this,
			__FUNCTION__,
			FieldList::create(
				TextField::create('Name'),
				EmailField::create('Email')
			),
			FieldList::create(
				FormAction::create('handleSubmission','Submit')
				->setUseButtonTag(true)
				->setTemplate('SubmitRecaptcha')
			),
			RequiredFields::create('Name','Email')
		);
		
		foreach ($form->Fields() as $field) {
			$field
				->addExtraClass('form-control')
				->setFieldHolderTemplate('CustomFormField_holder')
			;
		}
		
		if ($subscribed) {
			foreach ($form->Fields() as $field) 
				$field->setDisabled(true);
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
				
				$existing = Subscriber::get()->filter(array(
						'Email' => $data['Email']
				));
				
				if($existing->exists()) 
					return 'Email is already subscribed.';
				else {
					$contact = ContactPage::get()->first();
					
					$subscriber = Subscriber::create();
			
					$form->saveInto($subscriber);
			
					$subscriber->write();
					
					$email = new Email();

					$email->setTo($contact->EmailRecipient);
					$email->setFrom('noreply@tikiwine.com');
					$email->setSubject("New Subscriber: ". $data['Name'] .'<'. $data['Email'] .'>');
					
					$messageBody = '
						<p>Manage Subscribers at the <a href="http://tikiwine.com/admin">CMS</a></p>
					';
					$email->setBody($messageBody);
					$email->send();
					
					Session::set('subscribed', true);
					
					
					// add to MailChimp list
					$name = explode(' ', $data['Name']);

					$apiKey = $contact->MailChimpApiKey;
					$listID = $contact->MailChimpListID;
					
					// MailChimp API URL
					$memberID = md5(strtolower($data['Email']));
					$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
					$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;
					
					// member information
					$json = json_encode([
							'email_address' => $data['Email'],
							'status'        => 'subscribed',
							'merge_fields'  => [
									'FNAME'     => $name[0],
									'LNAME'     => empty($name[1]) ? ' ' : $name[1] 
							]
					]);
					
					// send a HTTP POST request with curl
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
					curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
					curl_exec($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					curl_close($ch);
					
					// store the status message based on response code
					if ($httpCode == 200) {
						$msg = 'Thanks for subscribing!';
					} else {
						switch ($httpCode) {
							case 214:
								$msg = 'You are already subscribed.';
								break;
							default:
								$msg = 'Some problem occurred, please try again.';
								break;
						}
					}
					
					return $msg;
				}
			}
			else 
				return 'Robot verification failed, please try again.';
		}
		else 
			return 'Robot verification failed, please try reloading this page.';
	}
}
