<?php
class Animals extends Controller
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

        $animals = $this->animalModel->getLast10Animals();
        $data = [
            'animals' => $animals
        ];

        $this->view('animals/index', $data);
    }

    public function allAnimals()
    {

        $animals = $this->animalModel->getAnimals();
        $data = [
            'animals' => $animals
        ];

        $this->view('animals/allAnimals', $data);
    }

    //add new animal
    public function add()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nom' => trim($_POST['nom']),
                'description' => trim($_POST['description']),
                'age' => trim($_POST['age']),
                'nom_err' => '',
                'description_err' => '',
                'age_err' => '',
            ];

            if (empty($data['nom'])) {
                $data['nom_err'] = "Entrer le nom de l'animal";
            }
            if (empty($data['description'])) {
                $data['description_err'] = 'Entrer la description';
            }
            if (empty($data['age'])) {
                $data['age_err'] = "Entrer l'age de l'animal";
            }

            //validate error free
            if (empty($data['nom_err']) && empty($data['description_err'])) {
                if ($this->animalModel->addAnimal($data)) {
                    flash('animal_message', 'Votre animal a été ajouté');
                    redirect('animals');
                } else {
                    die('erreur');
                }

                //laod view with error
            } else {
                $this->view('animals/add', $data);
            }
        } else {
            $data = [
                'nom' => (isset($_POST['nom']) ? trim($_POST['nom']) : ''),
                'description' => (isset($_POST['description']) ? trim($_POST['description']) : ''),
                'age' => (isset($_POST['age']) ? trim($_POST['age']) : '')
            ];

            $this->view('animals/add', $data);
        }
    }

    //show single post 
    public function show($id)
    {
        $animal = $this->animalModel->getAnimalById($id);

        $data = [
            'animal' => $animal,
        ];

        $this->view('animals/show', $data);
    }

    //edit animals
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'nom' => trim($_POST['nom']),
                'description' => trim($_POST['description']),
                'age' => trim($_POST['age']),
                'title_err' => '',
                'description_err' => '',
                'age_err' => '',
            ];
            //validate the nom
            if (empty($data['nom'])) {
                $data['nom_err'] = "Entrer le nom de l'animal";
            }
            //validate the description
            if (empty($data['description'])) {
                $data['description_err'] = 'Entrer la description';
            }

            //validate error free
            if (empty($data['title_err']) && empty($data['description_err'])) {
                if ($this->animalModel->updateAnimal($data)) {
                    flash('animals_message', 'Le post a été modifié');
                    redirect('animals');
                } else {
                    die('something went wrong');
                }

                //laod view with error
            } else {
                $this->view('animals/edit', $data);
            }
        } else {
            //check for the owner and call method from post model
            $animal = $this->animalModel->getAnimalById($id);
            $data = [
                'id' => $id,
                'nom' => $animal->nom,
                'description' => $animal->description,
                'age' => $animal->age
            ];

            $this->view('animals/edit', $data);
        }
    }

    //add new reservation
    public function addReservation($id)
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_animal' => $id,
                'text' => trim($_POST['text']),
            ];
            //validate error free
            if ($this->animalModel->addReservation($data)) {
                flash('animal_message', 'Votre animal a été ajouté');
                redirect('animals');
            } else {
                die('erreur');
            }
        } else {
            //check for the owner and call method from post model
            $animal = $this->animalModel->getAnimalById($id);
            $data = [
                'id' => $id,
            ];

            $this->view('animals/contact', $data);
        }
    }
}
