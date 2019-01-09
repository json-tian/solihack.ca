<?php
	global $email;
	$email = filter_input(INPUT_POST, 'email');

	if (!empty($email) && strstr($email, '@')) {
	    $host = "mysql.hostinger.com";
	    $dbusername = "u559630154_hack";
	    $dbpassword = "Oasswodd3";
	    $dbname = "u559630154_email";

	    //Create connection
	    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
	    if (mysqli_connect_error()) {
	        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
	    } else {
			$temp1 = htmlspecialchars($email, ENT_QUOTES);
	        $sql = "INSERT INTO subscriptions(email) VALUES ('$temp1')";
            if ($conn->query($sql)) {
	            header("Refresh:0; url=../index.html");
	        } else {
	            echo "Error: " . $sql . "<br>" . $conn->error;
	        }
	        $conn->close();
	    }
	} else {
		echo "Invalid Email.";
		die();
	}
?>