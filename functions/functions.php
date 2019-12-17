<?php
	$mysqli = false;

	function connectDB(){
		global $mysqli;
		$mysqli	 = new mysqli("localhost", "root", "", "newsbase");
		$mysqli->query("SET NAMES 'utf-8'");
	}

	 function closeBD(){
	 	global $mysqli;
	 	$mysqli ->close();
	 }

	 function getNews ($limit, $id, $key){
	 	if ($key ==1){
	 		global $mysqli;
	 		connectDB();
	 		if ($id)
	 			$where = "WHERE `id` = ".$id;
	 		$result = $mysqli->query("SELECT * FROM `news` $where ORDER BY `time` DESC LIMIT $limit");
	 		closeBD();
	 		if (!$id)
	 			return resultToArray ($result);
	 		else
	 			return $result->fetch_assoc();
	 	} else{
	 		global $mysqli;
	 	connectDB();
	 	if ($id)
	 		$where = "WHERE `id` = ".$id;
	 	$result = $mysqli->query("SELECT * FROM `news` $where ORDER BY `count` DESC LIMIT $limit");
	 	closeBD();
	 	if (!$id)
	 		return resultToArray ($result);
	 	else
	 		return $result->fetch_assoc();
	 	}
	 }

	 function resultToArray ($result){
	 	$array = array();
	 	while (($row = $result->fetch_assoc()) != false)
	 		$array[]=$row;
	 	return $array;
	 }

	 //Апдейт количества просмотров статьи
	 function views_update($id){
	 	global $mysqli;
	 	$mysqli->query("UPDATE news SET count= count + 2  WHERE id=$id");
	 }


	 function Parse($p1, $p2, $p3){
	 	$num1=strpos($p1, $p2);
	 	if ($num1===false) return 0;
	 	$num2 = substr($p1, $num1);
	 	return substr($num2, 0, strpos($num2, $p3)); 
	 }

//	 $String = file_get_contents('http://www.bntu.by/index.php?option=com_ninjarsssyndicator&feed_id=1&format=raw');

?>