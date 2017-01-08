<?php
/*
 * A simple service interface for saving the content 
 */
function save_pastebin(){
if( isset( $_REQUEST["content"] ) && isset( $_REQUEST["content_id"] ) ){
	$content = $_REQUEST["content"] ;
	$content_id = $_REQUEST["content_id"] ;
	$content_id = filter_var( trim($content_id), FILTER_SANITIZE_STRING) ;
	$content = filter_var( trim($content) , FILTER_SANITIZE_STRING) ;

	$success = null;
	$message = null;
	try{
		$fd = fopen('pastebin/'.$content_id.'.minetxt',"w");
		//var_dump($fd);
		if( $fd ){
			$success = fwrite($fd,$content);
			$fd = null;
		}
	}
	catch(Exception $e){
		//var_dump($e);
		$message = "Server error";
	}
	if( $success ){
		$message = "pastebin created - {$content_id}";
	}
	echo "{\"status\":true, \"message\":\"{$message}\"}";
}
else{
	echo '{"status":false,"message":"improper input"}';
}
}
header("Content-type:application/json");
save_pastebin();
?>
