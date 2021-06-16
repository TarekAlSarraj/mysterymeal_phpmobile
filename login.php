
<?php


$db = mysqli_connect('localhost','id16644001_mysterymealdb','gmd$0RC09+{NCa%U','id16644001_mysterymeal_db');

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    	$sql = "SELECT * FROM users WHERE email = '$email' " ;
    
    	$result = mysqli_query($db,$sql);
    
    	$arr = mysqli_fetch_array($result);
            
           
         
                    
                $hashedpassword = $arr['password'];
                
        
                if (password_verify($password, $hashedpassword) && mysqli_num_rows($result) ==1 ) {
                    echo json_encode("Success");
                } else {
                  echo json_encode("Error");
                }
           
   
      ?>  