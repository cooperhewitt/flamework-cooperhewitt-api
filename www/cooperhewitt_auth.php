<?php

	include("include/init.php");

	loadlib("cooperhewitt_users");
	loadlib("cooperhewitt_api");

	login_ensure_loggedin();

	features_ensure_enabled("cooperhewitt");

	$code = get_str("code");

	if (! $code){
		$url = $GLOBALS['cfg']['abs_root_url'] . "cooperhewitt/";
		header("location: {$url}");
		exit();
	}

	$rsp = cooperhewitt_api_get_access_token($code);

	if (! $rsp['ok']){

	}

	else if ($rsp['data']['error']){

	}

	else if (! $rsp['data']['access_token']){

	}

	else if ($rsp['data']['scope'] != 'write'){

	}

	else {

		if ($cooperhewitt_user = cooperhewitt_users_get_by_user_id($GLOBALS['cfg']['user']['id'])){

			$update = array(
				'access_token' => $rsp['data']['access_token'],
			);

			$rsp = cooperhewitt_users_update_user($cooperhewitt_user, $update);
		}

		else {

			$cooperhewitt_user = array(
				'user_id' => $GLOBALS['cfg']['user']['id'],
				'access_token' => $rsp['data']['access_token'],
			);

			$rsp = cooperhewitt_users_add_user($cooperhewitt_user);
		}
	}

	exit();
?>
