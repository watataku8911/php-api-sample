<?php
$dsn = "mysql:dbname=*********;host=*********;charset=utf8";
$user = "*********";
$pass = "**********";

try{
	$_id = $_GET["id"];
	$pdo = new PDO($dsn,$user,$pass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

	$sql = "select * from workes where id = :id and flg = 1 order by id desc";
	$stmt = $pdo->prepare($sql);
	$result = $stmt->execute(array(":id" => $_id));
	if($result&&$row=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$id = $row["id"];
		$title = $row["title"];
		$url = $row["url"];
		$git_url = $row["git_url"];
		$body = $row["body"];
		$imagePath = $row["image_path"];

		$returnArray["id"] = $id;
		$returnArray["title"] = $title;
		$returnArray["url"] = $url;
		$returnArray["git_url"] = $git_url;
		$returnArray["body"] = $body;
		$returnArray["imagePath"] = $_SERVER["DOCUMENT_ROOT"] + "/manegement_works/api/image/" . $imagePath;
	}
	$json = json_encode($returnArray);
	header("Content-Type: application/json; charset=utf-8");
	print($json);

}catch(PDOException $e){
	echo $e;
} 