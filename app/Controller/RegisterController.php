<?php

App::uses('Model', 'Model'); // Include the Model class
App::uses('User', 'Model'); // Include the User model

class RegisterController extends AppController {

    //Access User model
    public $uses = array('User');

    public function index() {
        if ($this->Auth->user()) {
            $this->redirect(['controller' => 'users', 'action' => 'index']); // Redirect to the dashboard if logged in.
        }

        if ($this->request->is('post')) {
            $this->User->create();
            $userData = $this->request->data['User'];

            // Set the user data to the modified data
            $this->User->set($userData);
    
            // Perform validation
            if ($this->User->validates()) {
                if ($this->User->save($userData)) {
                    // User registration was successful
                    $this->Session->setFlash('Thank you for registering!');
                    $this->setAction('success');
                }
            } else {
                $customErrors = [];
    
                foreach ($this->User->validationErrors as $field => $errors) {
                    foreach ($errors as $error) {
                        // Create custom error messages for specific fields
                        if ($field === 'name') {
                            $customErrors[$field][] = 'Your name is too short. Name must be at least 5 characters!';
                        } elseif ($field === 'email') {
                            $customErrors[$field][] = 'This email is already taken.';
                        } elseif ($field === 'password') {
                            $customErrors[$field][] = 'Your password is too short. Password must be at least 8 characters!';
                        } elseif ($field === 'confirm_password') {
                            $customErrors[$field][] = 'Password does not match!';
                        }
                    }
                }
                $this->set('customErrors', $customErrors);
            }
        }
    }
    
    
    public function success() {
        //  app/View/Register/success.ctp
    }

}