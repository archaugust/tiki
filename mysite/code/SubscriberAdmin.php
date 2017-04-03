<?php 
class SubscriberAdmin extends ModelAdmin {

	private static $menu_title = 'Subscribers';

	private static $url_segment = 'subscribers';

	private static $managed_models = array (
			'Subscriber'
	);
	
	private static $menu_icon = 'themes/wines/images/icon-newsletter.png';
}
?>