<?php 
require_once(SBINTERFACES);

class NotificationSubscribeContext implements ContextService {

	// ContextService interface
	public function getContext($model){
		return $model;
	}
	
	// ContextService interface
	public function setContext($context){
		$conn = $model['conn'];
		$parents = $model['parents'];
		
		$query = "";
		$size = count($parents);
		for($i=0; $i < $size, $i++){
			$query = $query." or nid = ".$parents[$i][0];
		}
		
		$query = "select * from notifications where ".substr($query, 4);
		$result = $conn->getResult($query);
		
		if($result === false){
			$model['valid'] = false;
			$model['msg'] = 'Error in Database';
			return $model;
		}
		
		$model['valid'] = true;
		$model['subscriptions'] = $result;
		return $model;
	}
}

?>
