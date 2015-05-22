<?php
	function processFailed($recommend,$msg){
		echo '{"message":[{"recommend":"'.$recommend.'","msg":"'.$msg.'"}],"success":"false"}';
	}
	function processSuccess($result){
		echo '{"message":[' . $result . '] ,"success":"true"}';
	}
?>