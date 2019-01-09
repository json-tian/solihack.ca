<?php
	global $valid;
	global $message;
	$valid = 1;
    global $email, $name, $age, $school, $grade, $grad, $major, $gender, $ethnicity, $resume, $tshirt, $conduct, $policy;
	$email = filter_input(INPUT_POST, 'email');
	$name = filter_input(INPUT_POST, 'name');
	$age = filter_input(INPUT_POST, 'age');
	$school = filter_input(INPUT_POST, 'school');
	$grade = filter_input(INPUT_POST, 'grade');
	$grad = filter_input(INPUT_POST, 'grad');
	$major = filter_input(INPUT_POST, 'major');
	$gender = $_POST['gender'];
	$tshirt = $_POST['tshirt'];
	$resume = filter_input(INPUT_POST, 'resume');

	$ethnicity = "";
	if(!empty($_POST['ethnicity'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['ethnicity'] as $selected){
			if ($ethnicity == "") {
				if ($selected == "Other") {
					$selected = filter_input(INPUT_POST, 'other_option');
				}
				$ethnicity = $selected;
			} else {
				if ($selected == "Other") {
					$selected = filter_input(INPUT_POST, 'other_option');
				}
				$ethnicity = $ethnicity . ";" . $selected;
			}
		}
	} else {
		$valid = 0;
		$message = "Please select those that apply.";
	}

	if((!isset($_POST['conduct']) && (!$_POST['conduct'] == 1))) {
		$valid = 0;
		$message = "Please accept the code of conduct.";
	} else {
		$conduct = 1;
	}

	if((!isset($_POST['policy']) && (!$_POST['policy'] == 1))) {
		$valid = 0;
		$message = "Please accept the privacy policy.";
	} else {
		$policy = 1;
	}

	//VALIDATION
	if (empty($email)) {
		$valid = 0;
		$message = "You forgot to enter your email.";
	}

	if (empty($name)) {
		$valid = 0;
		$message = "You forgot to enter your name.";
	}

	if (empty($age) || (!$age.is_numeric())) {
		$valid = 0;
		$message = "You forgot to enter your age.";
	} else {
		$age = intval($age);
	}

	if (empty($school)) {
		$valid = 0;
		$message = "You forgot to enter your school.";
	}

	if (empty($grade)) {
		$valid = 0;
		$message = "You forgot to enter your grade.";
	}

	if (empty($grad) || !$grad.is_numeric()) {
		$valid = 0;
		$message = "You forgot to enter your graduation year.";
	} else {
		$grad = intval($grad);
	}

	if (empty($resume)) {
		$valid = 0;
		$message = "You forgot to link your resume.";
	}

	if ($tshirt == "Select One") {
		$valid = 0;
		$message = "Please select a t-shirt size.";
	}

	if ($gender == "Select One") {
		$valid = 0;
		$message = "Please select one of the options.";
	}
	
	if ($valid == 1) {
	    $host = "mysql.hostinger.com";
	    $dbusername = "u559630154_soli";
	    $dbpassword = "SoliacCanada";
		$dbname = "u559630154_reg";

	    //Create connection
	    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
	    if (mysqli_connect_error()) {
	        die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
	    } else {
			//$email, $name, $age, $school, $grade, $grad, $major, $ethnicity, $resume, $conduct, $policy;
            $temp1 = htmlspecialchars($email, ENT_QUOTES);
			$temp2 = htmlspecialchars($name, ENT_QUOTES);
			$temp3 = htmlspecialchars($school, ENT_QUOTES);
			$temp4 = htmlspecialchars($grade, ENT_QUOTES);
			$temp5 = htmlspecialchars($major, ENT_QUOTES);
			$temp6 = htmlspecialchars($resume, ENT_QUOTES);
			$temp7 = htmlspecialchars($ethnicity, ENT_QUOTES);
	        $sql = "INSERT INTO user(Name, Age, Email, School, Grade, Grad, Major, Gender, Ethnicity, Resume, TShirt, Conduct, Policy)
			 VALUES ('$temp2', '$age', '$temp1', '$temp3', '$temp4', '$grad', '$temp5', '$gender', '$temp7', '$temp6', '$tshirt', '$conduct', '$policy')";
            if ($conn->query($sql)) {
	            header("Refresh:0; url=results.html");
	        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
	        }
	        $conn->close();
	    }
	} else {
		header("Refresh:0; url=error.html");
	}
?>