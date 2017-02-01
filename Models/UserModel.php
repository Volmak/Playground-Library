<?php
namespace Models;
use \DB;

class UserModel
{
	public static function login($args)
	{
		$resp = DB::query("SELECT id, password FROM `users` WHERE username=?;",[$args['username']]);
		
		if (isset($resp[0])){
			$userData = $resp[0];
		} else {
			return false;
		}
		
		if(!password_verify($args['password'], $userData['password'])){
			return false;
		}
		
		$_SESSION['loggedIn'] = true;
		$_SESSION['id'] = $userData['id'];
		$_SESSION['username'] = $args['username'];
		
		return true;
	}
	
	public static function logout()
	{
		$_SESSION['loggedIn'] = false;
		$_SESSION['id'] = '';
		$_SESSION['username'] = '';
	}

}