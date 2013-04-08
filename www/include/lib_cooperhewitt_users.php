<?php

	########################################################################

	function cooperhewitt_users_add_user($cooperhewitt_user){

		$cooperhewitt_user['created'] = time();

		$insert = array();

		foreach ($cooperhewitt_user as $k => $v){
			$insert[$k] = AddSlashes($v);
		}

		$rsp = db_insert('CooperhewittUsers', $insert);

		if ($rsp['ok']){
			$rsp['cooperhewitt_user'] = $cooperhewitt_user;
		}

		return $rsp;
	}

	########################################################################

	function cooperhewitt_users_update_user($cooperhewitt_user, $update){

		$insert = array();

		foreach ($update as $k => $v){
			$insert[$k] = AddSlashes($v);
		}

		$enc_id = AddSlashes($cooperhewitt_user['user_id']);
		$where = "user_id='{$enc_id}'";

		$rsp = db_update('CooperhewittUsers', $insert, $where);

		if ($rsp['ok']){
			$cooperhewitt_user = array_merge($cooperhewitt_user, $update);
			$rsp['cooperhewitt_user'] = $cooperhewitt_user;
		}

		return $rsp;
	}

	########################################################################

	function cooperhewitt_users_get_by_user_id($user_id){

		$enc_id = AddSlashes($user_id);

		$sql = "SELECT * FROM CooperhewittUsers WHERE user_id='{$enc_id}'";

		$rsp = db_fetch($sql);
		$row = db_single($rsp);

		return $row;
	}

	########################################################################

	# the end
