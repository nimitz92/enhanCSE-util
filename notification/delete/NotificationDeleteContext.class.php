<?php 
require_once(SBINTERFACES);

class NotificationCreateContext implements ContextService {

	// ContextService interface
	public function getContext($model){
		$conn = $model['conn'];
		$nname = $conn->escape($model['nname']);
		
		$query = "select nid from notifications where nname='$nname'";
		$result = $conn->getResult($query);
		
		if($result === false){
			$model['valid'] = false;
			$model['msg'] = 'Error in Database';
			return $model;
		}
		
		$model['gid'] = $result[0][0];
		$model['valid'] = true;
		return $model;
	}
	
	// ContextService interface
	public function setContext($context){		
		$nid = $model['gid'];
		$result = $conn->getResult("delete from notifications where nid=$nid);", true);
		
		if($result === false){
			$model['valid'] = false;
			$model['msg'] = 'Error in Database';
			return $model;
		}
		
		$model['valid'] = true;
		return $model;
	}
}

?>
