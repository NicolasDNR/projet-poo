<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //valide name
            if (empty($data['name'])) {
                $data['name_err'] = 'Entrer votre nom';
            }

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Entrer votre mail';
            } else {
                //check for email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Le mail existe deja';
                }
            }

            //validate password 
            if (empty($data['password'])) {
                $data['password_err'] = 'Entrer votre mot de passe';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = '6 caractères minimum';
            }

            //validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Confirmer votre mot de passe';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Mot de passe différent';
                }
            }

            //make sure error are empty
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['password_confirm_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if ($this->userModel->register($data)) {
                    flash('Utilisateur créé', 'Votre utilisateur a été créé, vous pouvez vous connecter');
                    redirect('users/login');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            //init data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Entrer votre mail';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    //user found
                } else {
                    $data['email_err'] = 'Utilisateur non trouvé';
                }
            }

            //validate password 
            if (empty($data['password'])) {
                $data['password_err'] = 'Entrer votre mot de passe';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = '6 caractère minimum';
            }

            //make sure error are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    //create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Mot de passe incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            //init data f f
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            //load view
            $this->view('users/login', $data);
        }
    }

    //setting user section variable
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        $_SESSION['role'] = $user->role;
        redirect('animals/index');
    }

    //logout and destroy user session
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        session_destroy();
        redirect('users/login');
    }
}
