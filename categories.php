<?php
$dsn = "mysql:dbname=*********;host=*********;charset=utf8";
$user = "*********";
$pass = "**********";

try{
	$pdo = new PDO($dsn,$user,$pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$sql = "select * from categories";
	$stmt = $pdo->query($sql);
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$categoryId = $row["category_id"];
		$categoryName = $row["category_name"];
		
		$returnArray["category_id"] = $categoryId;
		$returnArray["category_name"] = $categoryName;

		$arr[] = $returnArray;
	}

	$json = json_encode($arr);
	header("Content-Type: application/json; charset=utf-8");
	print($json);

}catch(PDOException $e){
	echo $e;
} 