<?php

namespace Models;
use \DB;

class TableModel
{
	protected static $startPage = TABLE_DEFAULTS['startPage'];
	protected static $perPage_default = TABLE_DEFAULTS['per_page'];
	protected static $orderBy_default = TABLE_DEFAULTS['order_by'];
	protected static $order_default = TABLE_DEFAULTS['order'];
	protected static $coversFolder = TABLE_DEFAULTS['covers_folder'];
	
	public static function getTablePage($args = [])
	{
		$page = isset($_SESSION['page']) ? $_SESSION['page'] - 1 : self::$startPage;
		$perPage = isset($_SESSION['perPage']) ? $_SESSION['perPage'] : self::$perPage_default;
		$orderBy = isset($_SESSION['orderBy']) ? $_SESSION['orderBy'] : self::$orderBy_default;
		$order = isset($_SESSION['order']) ? $_SESSION['order'] : self::$order_default;
		
		$start = $page * $perPage;
		$stop = $perPage;
		
		return DB::queryBind("SELECT * FROM book ORDER BY :orderBy :order LIMIT :start , :stop", [
				":orderBy" => $orderBy, 
				":order" => $order, 
				":start" => $start,
				":stop" => $stop
		]);
	}
	
	public static function getNumberOfPages($args = [])
	{
		$page = isset($_SESSION['page']) ? $_SESSION['page'] - 1 : self::$startPage;
		$perPage = isset($_SESSION['perPage']) ? $_SESSION['perPage'] : self::$perPage_default;
		
		$count = DB::query("SELECT COUNT(*) as c FROM book", [])[0]['c'];
		
		$results['pages'] = $count % $perPage ? 
				intval($count / $perPage) + 1 :
				$count / $perPage;
		$results['current'] = $page;
		return $results;
	}
	
	public static function deleteBook($args)
	{
		$id = str_replace('book', '', $args['id']);
		$page = isset($_SESSION['page']) ? $_SESSION['page'] - 1 : self::$startPage;
		$perPage = isset($_SESSION['perPage']) ? $_SESSION['perPage'] : self::$perPage_default;
		$orderBy = isset($_SESSION['orderBy']) ? $_SESSION['orderBy'] : self::$orderBy_default;
		$order = isset($_SESSION['order']) ? $_SESSION['order'] : self::$order_default;
		$offset = ($page + 1) * $perPage - 1;
		
		$cover = DB::query('SELECT cover FROM `book` WHERE id = ?', [$id]);
		@unlink(COVERS_FOLDER_LOCAL . $cover[0]['cover']);
		
		DB::query("DELETE FROM `book` WHERE `book`.`id` = ?", [$id]);
		return DB::queryBind("SELECT * FROM book ORDER BY :orderBy :order LIMIT 1 OFFSET :offset", [
				":orderBy" => $orderBy,
				":order" => $order, 
				":offset" => $offset
				
		]);
	}
	
	public static function editBook ($data)
	{
		$id = isset($data['key']) ? $data['key'] : false;
		
		if ($id && $id != intval($id)){	// no regulations on the ID ? Add here if any.
			return 'Invalid ID';
		}
		
		if ((isset($data['title']) && !$data['title']) //not really logical, but consider it a placeholder
				|| (isset($data['author']) && !$data['author']) 
				|| (isset($data['date']) 
						&& !preg_match('/^(19|20)\d\d-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/', $data['date']))
				|| (isset($data['format']) && (!$data['format'] || !preg_match('/^\w\d$/', $data['format'])))
				|| (isset($data['pages']) && $data['pages'] != intval($data['pages']))
				|| (isset($data['isbn']) && ($data['isbn'] < pow(10,12) || $data['isbn'] >= pow(10,13)))
				|| (isset($data['resume']) && (strlen($data['resume']) < 100 || strlen($data['resume'] > 65534))))
		{	
			return 'Data Error';  //This should be an Exception
		}
		
		if ($_FILES['file']['size']){
		
			$maxSize = 2097152; //2MB - too much?
	
			if (empty($_FILES['file']['type']) || $_FILES['file']['size'] > $maxSize 
					|| !preg_match('#^image/[A-z\-]{3,6}$#', $_FILES['file']['type']))
			{
				unlink( $_FILES['file']['tmp_name'] );
				return 'File error';
			}
			
			$copy = file_get_contents($_FILES['file']['tmp_name']);
			
			if (!@is_dir(COVERS_FOLDER_LOCAL)){
				if (!@mkdir(COVERS_FOLDER_LOCAL)){
					unlink( $_FILES['file']['tmp_name'] );
					return 'Acces denied!';
				}
			}
			
			do {
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$fileName = uniqid('cover' . rand(), true) . '.' .  $ext;
				$photo = COVERS_FOLDER_LOCAL . $fileName;
			} while(file_exists($photo));
			
			file_put_contents($photo, $copy);
			unlink( $_FILES['file']['tmp_name'] );	
		}
		
		if (!$id){
			DB::query('INSERT INTO book (title, author, cover, published, format, pages, isbn, resume,
					posted_by, last_edit_by) VALUES (?,?,?,?,?,?,?,?,?,?)',
				[$data['title'], $data['author'], $fileName, $data['date'], $data['format'], 
					$data['pages'], $data['isbn'], $data['resume'], $_SESSION['id'], $_SESSION['id']]);
		} else {
			$params = [];
			$sql = 'UPDATE book SET';
			if(isset($data['title'])){
				$sql .= ' title = ?,';
				$params[] = $data['title'];
			}
			if(isset($data['author'])){
				$sql .= ' author = ?,';
				$params[] = $data['author'];
			}
			if(isset($fileName)){
				$sql .= ' cover = ?,';
				$params[] = $fileName;
			}
			if(isset($data['date'])){
				$sql .= ' published = ?,';
				$params[] = $data['date'];
			}
			if(isset($data['format'])){
				$sql .= ' format = ?,';
				$params[] = $data['format'];
			}
			if (isset($data['pages'])){
				$sql .= ' pages = ?,';
				$params[] = $data['pages'];
			}
			if(isset($data['isbn'])){
				$sql .= ' isbn = ?,';
				$params[] = $data['isbn'];
			}
			if(isset($data['resume'])){
				$sql .= ' resume = ?,';
				$params[] = $data['resume'];
			}
			
			$sql .= ' last_edit_by = ? WHERE book.id = ?';
			$params[] = $_SESSION['id'];
			$params[] = $id;
			
			DB::query($sql, $params);
		}
	}
}