<?php
	session_start();

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);

	require_once 'auth.php';
	$user = new Auth();

	//Register Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'register'){
		$name = $user->test_input($_POST['name']);
		$email = $user->test_input($_POST['email']);
		$student_number = $user->test_input($_POST['student_num']);
		$pass = $user->test_input($_POST['password']);
		$hpass = password_hash($pass, PASSWORD_DEFAULT);

		if($user->user_exist($email)){
			echo $user->showMessage('Warning','This E-Mail is already registered!');
		}elseif ($user->name_exist($name)){
			echo $user->showMessage('Warning','This Name is already registered!');
		}
		elseif ($user->id_exist($student_number)){
			echo $user->showMessage('Warning','This school ID Number is already registered!');
		}
		

		else{
			if($user->register($name, $email, $student_number, $hpass)){
				echo 'register';
				$_SESSION['user'] = $email;
			}
			else{
				echo $user->showMessage('danger', 'Something went wrong! Try Later!');
			}

		}
	}

	//Login Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'login'){
		$email = $user->test_input($_POST['email']);
		$pass = $user->test_input($_POST['password']);

		$loggedInUser = $user->login($email);

		if($loggedInUser != null){
			if(password_verify($pass, $loggedInUser['password'])){
				if(!empty($_POST['rem'])){
					setcookie("email", $email, time()+(30*24*60*60),'/');
					setcookie("password", $pass, time()+(30*24*60*60),'/');
				}else{
					setcookie("email","",1,'/');
					setcookie("password","",1,'/');
				}

				echo 'login';
				$_SESSION['user'] = $email;
			}else{
				echo $user->showMessage('danger', 'Password is Incorrect');

			}
		}
		else{
			echo $user->showMessage('danger', 'User not found!');
		}
	}

	// Forgot Password Ajax
	if(isset($_POST['action']) && $_POST['action'] == 'forgot'){
		$email = $user->test_input($_POST['email']);

		$user_found = $user->currentUser($email);

		if($email != null){
			$token = uniqid();
			$token = str_shuffle($token);

			$user->forgot_password($token,$email);

			try{
				$mail->isSMTP();
				$mail->Host = 'smtp.mailtrap.io';
				$mail->SMTPAuth = true;
				$mail->Username = '9a5417329f9f93';
				$mail->Password = '1cdf4a384c3642';
				$mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 2525;

				$mail->setFrom(Database::USERNAME, 'CALIX');
				$mail->addAddress($email);

				$mail->isHTML(true);
				$mail->Subject = 'Reset Password';
				$mail->Body = '<h3>Click the link below to reset password. <br>
				<a href="http://localhost/user-system/reset-pass.php?email='.$email.'&token='.$token.'"> http://localhost/user-system/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Regards<br>CEIT Guidance!</h3>';

				$mail->send();
				echo $user->showMessage('success', 'We have send you the reset link in your email');
			}
			catch(Exception $e){
				echo $user->showMessage('danger', 'Something went wrong, Please Try Again Later');
			}
		}else{
			echo $user->showMessage('info', 'This E-mail is not registered');
		}
		
	}

	//Check User 
	if(isset($_POST['action']) && $_POST['action'] == 'checkUser'){
		if(!$user->currentUser($_SESSION['user'])){
			echo 'bye';
			unset($_SESSION['user']);
		}
	}
?>