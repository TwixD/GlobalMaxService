<?php
        function printErrorLog($text,$class,$method){
           file_put_contents(LOG_ERROR, LOG_DESC.$class.']['.$method.']:'.$text.PHP_EOL, FILE_APPEND | LOCK_EX);
    	}
    	function printSuccessLog($text,$class,$method){
           file_put_contents(LOG_SUCCESS, LOG_DESC.$class.']['.$method.']:'.$text.PHP_EOL, FILE_APPEND | LOCK_EX);
    	}
    	function printSecurityLog($text,$class,$method){
           file_put_contents(LOG_SECURITY, LOG_DESC.$class.']['.$method.']:'.$text.PHP_EOL, FILE_APPEND | LOCK_EX);
    	}
    	function printTransationLog($text,$class,$method){
           file_put_contents(LOG_TRANSATION, LOG_DESC.$class.']['.$method.']:'.$text.PHP_EOL, FILE_APPEND | LOCK_EX);
    	}
?>