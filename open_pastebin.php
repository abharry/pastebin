<?php
function open_pastebin(){
	$content = null ;
	$message = null ;
	$status = false ;
	if( isset( $_REQUEST["binid"] ) ){

	//sanitize
	$content_id = filter_var( trim( $_GET['binid'] ), FILTER_SANITIZE_STRING );
	try{
		$fd = file_get_contents("pastebin/".$content_id.".minetxt") ;
		if($fd){
			$content = $fd;
		}
		else{
			throw new Exception("File not found");
		}
	}
	catch(Exception $e){
		$message = "Pastebin not found!";
	}
	
	}
	else{
		$message = 'improper inputs';
	}
	$json = '{"status":"'.($status?'true':'false').'","content":"'.$content.'", "message":"'.$message.'"}';
	echo $json;
}
header('Content-type:application/json');
open_pastebin();
?>
