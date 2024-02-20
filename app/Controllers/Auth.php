<?php

namespace App\Controllers;

class Auth extends \IonAuth\Controllers\Auth
{
  public function __construct()
  {
      parent::__construct();
      // Volání konstruktoru původního controlleru, abyste zachovali jeho funkcionalitu
  }


  /**
   * If you want to customize the views,
   *  - copy the ion-auth/Views/auth folder to your Views folder,
   *  - remove comment
   */
  protected $viewsFolder = 'auth';

  public function signForm()
  {
    helper('form');
    return view('auth/login');
  }


  public function login()
	{
    $data = [];

		$this->data['title'] = lang('Auth.login_heading');

    $rules = [
      'identity' => 'required|valid_email',
      'password' => 'required|validate_user[identity, password]'
    ];

    $errors = [
      'identity' => [
        'required' => 'Vyplň přihlašovací údaje!',
        'valid_email' => 'Vyplň správný formát Emailu!'
      ],
      'password' => [
        'required' => 'Vyplň heslo!',
        'validate_user' => 'Přihlašovací údaje nejsou platné!'
      ]
    ];

    if (!$this->validate($rules, $errors)) {
      $data['validation'] = $this->validator;
    }else {
       // check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->request->getVar('remember');

			if ($this->ionAuth->login($this->request->getVar('identity'), $this->request->getVar('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->setFlashdata('message', $this->ionAuth->messages());
				return redirect()->to('/');
			}
    }

    
    return view('auth/login', $data);
	}
}
