<?php
	$conn = new mysqli('localhost', 'root', '', 'thuctapnhom');
	// echo'<pre>';print_r($conn);die;
	$sql_select_category = 'SELECT * FROM category';
	$sql_select_brand = 'SELECT * FROM brand';
	$result = mysqli_query($conn, $sql_select_category);
	$result1 = mysqli_query($conn, $sql_select_brand);
	while ($row = mysqli_fetch_assoc($result)){
		$category[] = $row;
	}
	while ($row = mysqli_fetch_assoc($result1)){
		$brand[] = $row;
	}
	if (isset($_POST['add_product'])) {
		$id_category = addslashes($_POST['id_category']);
		$id_brand = addslashes($_POST['id_brand']);
		$product_name = addslashes($_POST['product_name']);
		$product_description = addslashes($_POST['product_description']);
		$product_quantity = addslashes($_POST['product_quantity']);
		$product_price = addslashes($_POST['product_price']);
		$file_info = $_FILES["product_image"];
		$file_name = $file_info['name'];
		$product_image = $file_info['name'];
		$file_tmp_name = $file_info['tmp_name'];
		$file_size = $file_info['size'];
		$array_name_file = explode(".", $file_name);
		$file_type = end($array_name_file);
		$position_file_type = strpos($file_name, '.'.$file_type);
		$name_edit = substr($file_name, 0, $position_file_type);
		$file_name_attached = $name_edit .'.'. $file_type;
		$save_to = 'images/' . $file_name_attached;
		move_uploaded_file($file_tmp_name, $save_to);
		$sql_insert = 'INSERT INTO `product`(`name`, `category`, `brand`, `description`,
		`quantity`, `price`, `image`) VALUES ("'.$product_name.'",
		"'.$id_category.'","'.$id_brand.'","'.$product_description.'","'.$product_quantity.'","'.$product_price.'","'.$product_image.'")';
		if ($conn->query($sql_insert) == TRUE) {
			echo "<script>alert('Add product confirm');</script>";
		} else {
			echo "<script>alert('Add product error');</script>";
		}
	}
	include_once('add.html');
	// echo'<pre>';print_r($category);die;
?>

