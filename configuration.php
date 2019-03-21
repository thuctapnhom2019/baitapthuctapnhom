<?php
	$conn = new mysqli('localhost', 'root', '', 'thuctapnhom');
	// echo'<pre>';print_r($conn);die;
	$sql_select = 'SELECT * FROM product';
	$result = mysqli_query($conn, $sql_select);
	while ($row = mysqli_fetch_assoc($result)){
		$product[] = $row;
	}
	foreach ($product as $key => $value) {
		$sql_select_cate = 'SELECT name FROM category where id = '.$value['category'].'';
		$result_cate = mysqli_query($conn, $sql_select_cate);
		$product[$key]['name_category'] = mysqli_fetch_assoc($result_cate)['name'];
		$sql_select_brand = 'SELECT name FROM brand where id = '.$value['brand'].'';
		$result_brand = mysqli_query($conn, $sql_select_brand);
		$product[$key]['name_brand'] = mysqli_fetch_assoc($result_brand)['name'];
	}
	// echo'<pre>';print_r($product);die;
	include_once('configuration.html');
	// echo'<pre>';print_r($category);die;
?>

