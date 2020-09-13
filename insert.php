<?php
$username=$_POST['username'];
$username=$_POST['password'];
$username=$_POST['gender'];
$username=$_POST['email'];
$username=$_POST['phoneCode'];
$username=$_POST['phone'];

if(!empty($username)|| !empty($password)|| !empty($gender)|| !empty($email)|| !empty($phoneCode)|| !empty($phone))

{
	$host="localhost";
	$dbusername="root@localhost";
	$dbpassword="";
	$dbname="register";

	//create connection
	$connection=new mysqli($host,$dbusername,$dbpassword,$dbname);
 
 if(mysqli_connectionerror()){
 	die('connection error('.mysqli_connection_error().')'.mysqli_connection_error());
}else{
	$SELECT="SELECT email From register Where email =? Limit 1"; 
	$INSERT="INSERT Into register(username,password,gender,email,phoneCode,phone) values(?,?,?,?,?,?)";
	//preparing statement
	$stmt=$connection->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum=$stmt->num_rows;

	if($rnum==0){
		$stmt->close();
		$stmt=$connection->prepare($INSERT)
		$stmt->bind_param("ssssii", $username, $password, $gender, $email, $phoneCode, $phone ) ;
		$stmt->execute();
		echo "New record has inserted  successfully";

	}else{
		echo "someone already registred using this email";
	}
	$stmt->close();
	$connection->close();
}

}else
{
	echo "all fields are required";
	die();
}