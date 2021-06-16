<?php
require_once('./connection.php');
$keys=array('firstname','lastname','username','email','password');
//$keys=array('name','mobile','password','type');
for ($i = 0; $i < count($keys); $i++){
	if(!isset($_POST[$keys[$i]])){
		  $response['error'] = true;
			$response['message'] = 'Required Filed Missed';
			echo json_encode($response);
		  return;
	 }
}

$password=PASSWORD_HASH($_POST['password'], PASSWORD_DEFAULT);
$email=$_POST['email'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$username=$_POST['username'];
$profile_type='App\Costumer';

//checking if the user is already exist with this username or email
					//as the email and username should be unique for every user
				    $stmt = $con->prepare("SELECT id FROM users WHERE email = ? ");
					$stmt->bind_param("s", $email);
					$stmt->execute();
					$stmt->store_result();
					//if the user already exist in the database
					if($stmt->num_rows > 0){
						$response['error'] = true;
						$response['message'] = 'User already registered';
						$stmt->close();
					}else{
						//if user is new creating an insert query
						$stmt = $con->prepare("INSERT INTO users (firstname, lastname, username, email, password, profile_type) VALUES (?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("ssssss",  $firstname, $lastname, $username, $email, $password, $profile_type);

						//if the user is successfully added to the database
						if($stmt->execute()){

							//fetching the user back
							$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
							$stmt->bind_param("s",$email);
							$stmt->execute();
							$stmt->bind_result( $id, $firstname, $lastname, $username, $email, $password, $profile_type);
							$stmt->fetch();

							$user = array(
								'id'=>$id,
								'firstname'=>$firstname,
								'lastname'=>$lastname,
								'username'=>$username,
								'email'=>$email,
								'password'=>$password
							);

							$stmt->close();

							//adding the user data in response
							$response['error'] = false;
							$response['message'] = 'User registered successfully';
							$response['data'] = $user;

						}

					}
					echo json_encode($response);
?>