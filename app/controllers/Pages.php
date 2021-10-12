<?php
class Pages extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect('users/login');
    }
    //new model instance
    $this->animalModel = $this->model('Animal');
    $this->userModel = $this->model('User');
  }

  public function index()
  {
    if (isLoggedIn()) {
      redirect('animals');
    }
    $data = [
      'title' => 'SharePosts',
      'description' => 'Simple social network built on the Emmizy MVC framework',
      'info' => 'You can contact me with the following details below if you like my program and willing to offer me a contract and work on your project',
      'name' => 'Omonzebaguan Emmanuel',
      'location' => 'Nigeria, Edo State',
      'contact' => '+2348147534847',
      'mail' => 'emmizy2015@gmail.com'
    ];

    $this->view('pages/index', $data);
  }

  public function contact()
  {
    $data = [
      'title' => 'Nous contacter',
      'description' => 'Vous pouvez nous contacter grâce aux information ci-dessous.',
      'name' => 'Laure Bouchaux',
      'location' => 'France, Paris',
      'contact' => '+33655829512',
      'mail' => 'laure.bouchaux@gmail.com'
    ];

    $this->view('pages/contact', $data);
  }

  public function backOfficeAnimaux()
  {

    $reservation = $this->animalModel->getAnimalReservation();
    $data = [
      'reservation' => $reservation
    ];
    $this->view('pages/backOfficeAnimaux', $data);
  }

  public function backOfficeUsers()
  {

    $users = $this->userModel->getUsers();
    $data = [
      'users' => $users
    ];
    $this->view('pages/backOfficeUsers', $data);
  }

  public function update($id, $role)
  {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if ($role === "0") {
      $data = [
        'id' => $id,
        'role' => "1",
      ];
    } else if ($role === "1") {
      $data = [
        'id' => $id,
        'role' => "0",
      ];
    }

    $this->userModel->updateUserRole($data);
    redirect('pages/backOfficeUsers');
  }
}
