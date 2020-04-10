<?php

class LoginController extends Controller
{

	/*
	  Display the login form and process user input.
	*/
	public function index()
	{
		if(isset($_POST['action']))
		{
            $theUser = $this->model('User')->findUser($_POST['username']);

           if($theUser != null && password_verify($_POST['password'], $theUser->password_hash))
           {
            	$_SESSION['user_id'] = $theUser->user_id;
           		header('location:/home/index');
           }

           else
           {
           		$this->view('login/index', 'Incorrect Username/Password Combination!');
           }

        }

		else
		{
			$this->view('login/index');
		}
	}

    /*
      Display the register form and process new registration.
    */
	public function register()
	{
		if(isset($_POST['action']))
		{
			$newUser = $this->model('User');
			$theUser = $newUser->findUser($_POST['username']);

			if($theUser == null && $_POST['password'] == $_POST['password_confirm'])
			{	    
				$newUser->username = $_POST['username'];	
				$newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			    $newUser->create();
			    header('location:/login/index');
			}	

			$this->view('login/register', 'Username Already in Use or Passwords Did Not Match!');
		}

		else
		{
			$this->view('login/register');
		}

	}


	/*
	  Process logout requests.
	*/
	 public function logout()
	 {
	 	session_destroy();
	 	header('location:/login/index');
	 }

}

?>