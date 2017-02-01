<?php
/**
 * The funny name is because in this file will serve as MVC's Model and Controller
 */

namespace Controllers;

use Models\TableModel;
use Models\UserModel;

class Controller
{
	protected static $viewPath = '/../views/';
	
	protected static function render ($view, $args = null)
	{
		ob_start();
		require realpath(__DIR__ . self::$viewPath . $view . '.php');
		echo ob_get_clean();
	}
	
	protected static function renderContent ($view, $args = null)
	{
		ob_start();
		echo '<section id="content">';
		require realpath(__DIR__ . self::$viewPath . $view . '.php');
		echo '</section>';
		echo ob_get_clean();
	}
	
	public static function __callstatic($mthd, $args = null)
	{
		//in need of middleware? add here!
		if(empty($_SESSION['loggedIn']) && $mthd != 'login'){
			self::index($args);
			return;
		}
		
		if(method_exists(__CLASS__, $mthd)){
			self::$mthd($args);
		} else {
			self::missing();
		}
	}
	
	public static function header($args = null)
	{
		self::render('header', $args);
	}
	
	public static function index ($args = null)
	{
		if (empty($_SESSION['loggedIn'])){
			self::header();
			self::render('index');
		} else {
			self::table();
		}
	}
	
	public static function missing ()
	{
		self::header(['index']);
		self::renderContent('missing');
	}
	
	public static function login ($args)
	{
		if (UserModel::login($args)){
			self::table();
		} else {
			return false;
		}
	}
	
	public static function logout()
	{
		UserModel::logout();
		self::header();
		self::render('index');
	}
	
	public static function table ($args = null)
	{
		self::header(['add','logout']);
		self::renderContent('table', TableModel::getTablePage($args));
		self::render("pageNav", TableModel::getNumberOfPages($args));
	}
	
	public static function editForm ($args = null)
	{
		self::header(['table','logout']);
		self::renderContent('editForm', $args);
	}
	
	public static function edit ($args) 
	{
		$error = TableModel::editBook($args);
		if ($error) {
			die ('error: ' . $error);
		} else {
			self::table();
		}
	}
	
	public static function delete ($args)
	{
		self::render('table', TableModel::deleteBook($args));
	}
	
	public static function tablePage($args)
	{
		$_SESSION['page'] = $args['page'];
		self::table();
	}
}