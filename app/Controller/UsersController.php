<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->deny('index');
        $this->Auth->allow(array('controller'=>'register', 'action'=>'index'), 'login', 'logout');
    }

    public function login() {
        // prevents the user from accessing a particular page by explicitly changing the url
        if ($this->Auth->user()) {
            $this->redirect(['controller' => 'users', 'action' => 'index']); // Redirect to the dashboard if logged in.
        }

        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash('Invalid email or password. Please try again.');
            }
        }
    }
    
    // USER'S DASHBOARD
    public function index() {
        // Retrieve the currently logged-in user's data.
        $userData = $this->Auth->user();

        // Set a view variable with the user data.
        $this->set('userData', $userData);
    }

    public function edit($id = null) {
        // Check if the record exists
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('User not found!'));
        }
    
        // Fetch the user data to display in the form
        $userData = $this->User->findById($id);
    
        // Check if the request is a POST request (form submission)
        if ($this->request->is('post') || $this->request->is('put')) {
            // Set the model's ID to the user's ID for updating
            $this->User->id = $id;
    
            // Check if a new image file is uploaded
            if (!empty($this->request->data['User']['image']['tmp_name'])) {
                // Read the contents of the uploaded file
                $imageData = file_get_contents($this->request->data['User']['image']['tmp_name']);
    
                // Save the image data to the database
                $this->User->saveField('image', $imageData);
            }

            $name = $this->request->data['User']['name'];
            $gender = $this->request->data['User']['gender'];
            $birthdate = $this->request->data['User']['birthdate'];
            $hobby = $this->request->data['User']['hobby'];

            $data = array(
                    'name' => $name,
                    'gender' => $gender,
                    'birthdate' => $birthdate,
                    'hobby' => $hobby,
                );

            // var_dump(($this->request->data));
            // die();
            
            // Attempt to save the updated user data
            if ($this->User->save($data)) {
                $this->User->id = $id;
                $this->Session->setFlash('Profile updated successfully.');
                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error updating profile.');
            }
            if (!$this->request->data)
            $this->request->data = $userData;
        }
        $this->set('userData', $userData);
    }

    public function displayImage($userId) {
        $user = $this->User->findById($userId);
        if ($user && !empty($user['User']['image'])) {
            $this->response->type('image/jpeg'); // Change the type based on your image type.
            $this->response->body($user['User']['image']);
            return $this->response;
        }
        // Handle errors if user or image not found.
    }

    // DELETE USER'S MESSAGES/CONVERSATIONS
    public function delete($id) { // app/View/Users/delete.ctp

        $this->User->id = $id;

        if($this->request->is(array('post', 'put', 'delete'))) {
            if($this->User->delete()) {
                $this->Session->setFlash('The user has been deleted!');
                $this->redirect('index');
            }
        }
    }

    public function logout() {
        // $this->Auth->logout();
        // $this->redirect($this->Auth->logoutRedirect());
        $this->redirect($this->Auth->logout());
    }

    public function view_chat($user_id) {
        // Set the current user's ID
        $currentUserId = $this->Auth->user('id');
        $this->set('currentUserId', $currentUserId);
    
        // Load the chat messages
        $this->loadModel('Message'); // Load the Message model if not already loaded
        $this->Message->recursive = -1; // Load messages without related data
        $this->set('messages', $this->Message->getChatMessages($user_id, $currentUserId));
    }

    
}// end of class UserController

?>