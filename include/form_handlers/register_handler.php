<?php
//Declaring variables to prevent errors
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$em2 = ""; //email 2
$password = ""; //password
$password2 = ""; //password2
$date = ""; // sign up date
$error_array = []; //Holds error messages

if(isset($_POST['register_button']))
{
	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove html tags
	$fname = str_replace(' ','',$fname); //remove spaces
	$fname = ucfirst(strtolower($fname)); //uppercase first letter
	$_SESSION['reg_fname'] = $fname; // store to session

    //Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove html tags
	$lname = str_replace(' ','',$lname); //remove spaces
	$lname = ucfirst(strtolower($lname)); //uppercase first letter
	$_SESSION['reg_lname'] = $lname; // store to session

	//Email
	$em = strip_tags($_POST['reg_email1']); //Remove html tags
	$em = str_replace(' ','',$em); //remove spaces
	$em = ucfirst(strtolower($em)); //uppercase first letter
	$_SESSION['reg_email1'] = $em; // store to session

	//Email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html tags
	$em2 = str_replace(' ','',$em2); //remove spaces
	$em2 = ucfirst(strtolower($em2)); //uppercase first letter
	$_SESSION['reg_email2'] = $em2; // store to session

	//Password 1/2
	$password = strip_tags($_POST['reg_password']); //Remove html tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove html tags

	$date = date("Y-m-d"); // current date

	if($em == $em2)
	{
		// validate email format
	    if(filter_var($em, FILTER_VALIDATE_EMAIL)){
	    	$em = filter_var($em, FILTER_VALIDATE_EMAIL);

	    	// check if email already exists
	    	$e_check = mysqli_query($con, "SELECT email from users WHERE email='$em'");
	    	// count number of the rows returned
	    	$num_rows = mysqli_num_rows($e_check);
	    	if($num_rows > 0)
	    	{
	    		array_push($error_array, "Email already exists<br>");
	    	}
	    }
	    else{
	    	array_push($error_array, "Invalid email format<br>");
	    }
	}
	else
	{
		array_push($error_array, "Emails don't match<br>");
	}

	if(strlen($fname) > 25 || strlen($fname) < 2)
	{
		array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
	}

	if(strlen($lname) > 25 || strlen($lname) < 2)
	{
		array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
	}

	if($password != $password2){
		array_push($error_array, "Your passwords don't match<br>");
	}
	else
	{
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
		}
	}

	if(strlen($password) > 30 || strlen($password) < 5){
		array_push($error_array, "Your password must be between 5 and 30 characters<br>");
	}

	$username = '';
	if(empty($error_array))
	{
		$password = md5($password);

		//generating user name by concactenating the first name and last name
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

        //check if the user name already exists
		$i = 0;
		while(mysqli_num_rows($check_username_query) != 0)
		{
			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		//Profile picture assignment
		$rand = rand(1, 2);

		if($rand == 1)
			$profile_pic = "assets/images/profile_pics/defaults/head_deep_blue.png";
		else if($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/head_emerald.png";

		$query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

		array_push($error_array, "<span style='color: #14c800;'>You're all set! GO ahead and login!</span><br>");

		//clear session varibles
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email1'] = "";
		$_SESSION['reg_email2'] = "";
	}
}
?>