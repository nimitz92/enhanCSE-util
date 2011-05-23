<?php 
require_once(SBINTERFACES);

class NotificationCreateContext implements ContextService {

	// ContextService interface
	public function getContext($model){
		$conn = $model['conn'];
		$nname = $conn->escape($model['nname']);
		
		$query = "select nname from notifications where nname='$nname'";
		$result = $conn->getResult($query);
		
		if($result === false){
			$model['valid'] = false;
			$model['msg'] = 'Error in Database';
			return $model;
		}
			
		if(count($result) != 0){
			$model['valid'] = false;
			$model['msg'] = 'Notification name already registered';
			return $model;
		}
		
		$model['valid'] = true;
		$model['gname'] = $nname;
		return $model;
	}
	
	// ContextService interface
	public function setContext($context){
		$conn = $model['conn'];
		$nname = $conn->escape($model['nname']);
		$ndesc = $conn->escape($model['ndesc']);
		
		$nid = $model['nid'];		
		$result = $conn->getResult("insert into notifications (nid, nname, ndescription) values ($nid, '$nname', '$ndesc');", true);
		
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
