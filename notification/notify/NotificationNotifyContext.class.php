<?php 
require_once(SBINTERFACES);
require_once(SBROOT. 'lib/util/Mail.class.php');

class NotificationNotifyContext implements ContextService {

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
		
		$model['valid'] = true;
		$model['gid'] = $result[0][0];
		return $model;
	}
	
	// ContextService interface
	public function setContext($model){
		$conn = $model['conn'];
		$users = $model['leaves'];
		$subject = $model['subject'];
		$message = $model['message'];
		
		$to = "";
		$size = count($users);
		for($i=0; $i < $size; $i++){
			$to = $to.",".$users[$i][2];
		}
		
		$to = substr($to, 1);
		//echo $to;
		$model['sent'] = Mail::send($to, $subject, $message);
		//echo $model['sent'];
		if($model['sent'] === false){
			$model['valid'] = false;
			$model['msg'] = 'Error in Sending Mail';
			return $model;
		}
		
		$model['valid'] = true;
		return $model;
	}
}

?>
