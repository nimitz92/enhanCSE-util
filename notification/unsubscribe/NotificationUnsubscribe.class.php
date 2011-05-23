<?php 
require_once(SBINTERFACES);
require_once(SBCOMLOADER);

require_once('NotificationUnsubscribeContext.class.php');
require_once('NotificationUnsubscribeTransform.class.php');

class NotificationUnsubscribe implements Operation {
	protected 
		// adapter
		$adapter;
		
	// Constructor
	public function __construct(){
		$cl = new ComponentLoader();
		$this->adapter = $cl->load("base.adapter", SBROOT);
	}

	// Operation interface
	public function getRequestService(){
		return $this->adapter->getRequestService();
	}
	
	// Operation interface
	public function getContextService(){
		return new NotificationUnsubscribeContext();
	}
	
	// Operation interface
	public function getTransformService(){
		return new NotificationUnsubscribeTransform();
	}
	
	// Operation interface
	public function getResponseService(){
		return $this->adapter->getResponseService();
	}
}

?>