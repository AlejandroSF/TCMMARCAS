<?php

include_once '../models/PersistentObject';

session_start();
if (isset($_SESSION['Game'])){
	include $_SESSION['Game']->activeChallenge->image->filePath;
}else{
	http_response_code(401);
}

?>