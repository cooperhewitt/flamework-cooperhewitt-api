<?php

	include("include/init.php");

	login_ensure_loggedin();
	features_ensure_enabled("cooperhewitt");

	loadlib("cooperhewitt_users");
	loadlib("cooperhewitt_api");

	if ($cooperhewitt_user = cooperhewitt_users_get_by_user_id($GLOBALS['cfg']['user']['id'])){
		$GLOBALS['smarty']->assign_by_ref("cooperhewitt_user", $cooperhewitt_user);
	}

	$auth_url = cooperhewitt_api_authenticate_user_url();
	$GLOBALS['smarty']->assign("auth_url", $auth_url);

	$GLOBALS['smarty']->display("page_cooperhewitt.txt");
	exit();

?>
