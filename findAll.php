<?php
$dsn = "mysql:dbname=*********;host=*********;charset=utf8";
$user = "*********";
$pass = "**********";

try{
	$pdo = new PDO($dsn,$user,$pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	$sql = "select * from workes where flg = 1 order by id desc";
	$stmt = $pdo->query($sql);
	$arr = [];
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$id = $row["id"];
		$title = $row["title"];
		$url = $row["url"];
		$git_url = $row["git_url"];
		$body = $row["body"];
		$image_path = $row["image_path"]; 

		$returnArray["id"] = $id;
		$returnArray["title"] = $title;
		$returnArray["url"] = $url;
		$returnArray["git_url"] = $git_url;
		$returnArray["body"] = $body;

		/*http://localhost:8888/watatakuを消す*/
		$returnArray["imagePath"] = $_SERVER["DOCUMENT_ROOT"] + "/manegement_works/api/image/".$image_path;
		$arr[] = $returnArray;

	}
	$json = json_encode($arr);
	header("Content-Type: application/json; charset=utf-8");
	print($json);

}catch(PDOException $e){
	echo $e;
} 