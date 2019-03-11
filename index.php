<?php
	$conn = mysqli_connect('localhost', 'root', '', 'thuctapnhom') or die ('Không thể kết nối tới database');
	// $sql = 'CREATE TABLE IF NOT EXISTS `customer` (
		  // `id` INT(11) NOT NULL AUTO_INCREMENT,
		  // `name` VARCHAR(32) COLLATE utf8_unicode_ci DEFAULT NULL,
		  // `phone` int(32) COLLATE utf8_unicode_ci DEFAULT NULL,
		  // `address` text(255) COLLATE utf8_unicode_ci DEFAULT NULL,
		  // `email` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
		  // `password` VARCHAR(32) COLLATE utf8_unicode_ci DEFAULT NULL,
		  // PRIMARY KEY (`id`)
		// ) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
		// ';
	// $sql_insert = "INSERT INTO `customer` (`name`, `phone`, `address`, `email`, `password`) VALUES
			// ('Nguyen Van A', '0374093199', 233 saa s, "admin@admin.com", 123456)";
	$sql_select = 'SELECT * FROM customer';
	$result = mysqli_query($conn, $sql_select);
	if (!$result){
		die ('Câu truy vấn bị sai');
	}
	while ($row = mysqli_fetch_assoc($result)){
		$infor_cus[] = $row;
	}
	// mysqli_close($conn);
	$filename = "login.html";
	echo file_get_contents($filename);
	if (isset($_POST['login'])) {
		$user_email = addslashes($_POST['user_email']);
		$user_password = addslashes($_POST['user_password']);
		// echo'<pre>';print_r($user_email);
		// echo'<pre>';print_r($_POST);die;
		if (!$user_email || !$user_password) {
			echo "<script>alert('Please enter email and password');</script>";
			return false;
		}
		$query = mysqli_query($conn, "SELECT email, password FROM customer WHERE email='".$user_email."'");
		$check = array();
		while ($row = mysqli_fetch_assoc($query)){
			$check[] = $row;
		}
		// echo'<pre>';print_r($check);die;
		if (count($check) == 0) {
			echo "<script>alert('Email not exist. Please check again');</script>";
			return false;
		}
		$pass_check = $check[0];
		if ($user_password != $pass_check['password']) {
			echo "<script>alert('Password not right. Please check again');</script>";
			return false;
		} else {
			return header("Location: addproduct.php");
		}
	}
	// echo'<pre>';print_r($infor_cus);die;