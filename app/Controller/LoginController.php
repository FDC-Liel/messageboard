<?php

// app/Controller/LoginController.php

class LoginController extends AppController {

    // Include the User model
    public $uses = array('User'); 

    // app/Controller/LoginController.php
    public function index() {
        if ($this->request->is('post')) {
            $email = $this->request->data['User']['email'];
            $password = $this->request->data['User']['password'];

            $user = $this->User->find('first', array(
                'conditions' => array('User.email' => $email),
            ));

            if ($user && $this->User->hasCorrectPassword($user, $password)) {
                // Update the user's last_login_time
                $this->User->id = $user['User']['id'];
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));

                $this->Auth->login($user); // Log the user in

                $this->Session->setFlash('Login successful.');
                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Invalid email or password. Please try again.');
            }
        }
    }


}

?>