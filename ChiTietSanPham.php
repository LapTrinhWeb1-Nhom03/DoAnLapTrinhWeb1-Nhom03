<?php
	
	include_once 'lib/db.php';
	if(!isset($_GET["MaSP"]))
	{
		header('location: index.php');
	}
	$masanpham = $_GET["MaSP"];
	$sql = "update sanpham set LuotXem = LuotXem +1 where MaSP = $masanpham";
	load($sql);
	$sql = "select * from sanpham where MaSP = $masanpham";
    $list = load($sql);
    $row= $list->fetch_assoc();
	$tilte = $row["TenSP"];
	include_once 'share/header.php';
	include_once 'module/ChiTiet.php';
	include_once 'share/footer.php';