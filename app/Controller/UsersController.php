<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->deny('index');
        $this->Auth->allow(array('login', 'logout'));
    }

    public function login() {
        // prevents the user from accessing a particular page by explicitly changing the URL
        if ($this->Auth->user()) {
            $this->redirect(['controller' => 'users', 'action' => 'index']); // Redirect to the dashboard if logged in.
        }
    
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // Get the logged-in user's ID
                $userId = $this->Auth->user('id');
    
                // Load the User model
                $this->loadModel('User');
    
                // Find the user by ID
                $user = $this->User->findById($userId);
    
                if ($user) {
                    // Update the last_login_time field
                    $this->User->id = $userId;
                    $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
                }
    
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash('Invalid email or password. Please try again.');
            }
        }
    }
    
    
    // USER'S DASHBOARD
    public function index() {
        // Retrieve the currently logged-in user's data.
        // $userData = $this->Auth->user(); 
        $id = $this->Session->read('Auth.User.id');
        $userData = $this->User->findById($id);

        // Set a view variable with the user data.
        $this->set('userData', $userData);
    }

    public function edit() {
    // public function edit($id = null) {
        // Fetch the user data to display in the form
        // $userData = $this->User->findById($id);
        $userData = $this->Session->read('Auth.User.id');
    
        // Check if the record exists
        if (!$this->User->exists($userData)) {
            throw new NotFoundException(__('User not found!'));
        }

        // Check if the request is a POST request (form submission)
        if ($this->request->is('post') || $this->request->is('put')) {
            // Set the model's ID to the user's ID for updating
            $this->User->id = $userData;

            $uploadedFile = $this->request->data['User']['image'];
                
                // File path
                $filePath = WWW_ROOT .'img'. DS;

                // Check if there is file directory
                if (!file_exists($filePath)) {
                    mkdir($filePath,0777,true);
                }

                if (!empty($uploadedFile['name'])) {

                    $fileName  = uniqid() .'-'. $uploadedFile['name'];

                    $targetPath = $filePath . $fileName;

                    if(move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {
                        // Update the img data into pathname 
                        $this->request->data['User']['image'] = $fileName;
                        
                    } else {
                        $this->Flash->error('Failed to upload image!', array(
                            'key' => 'error',
                        ));
                        $this->redirect('index');
                    }

                } else {
                    // Use this if the user has a profile pic and doesn't want to change the profile pic
                    unset($this->request->data['User']['image']);
                } 
            
            $name = $this->request->data['User']['name'];
            $gender = $this->request->data['User']['gender'];
            $birthdate = $this->request->data['User']['birthdate'];
            $hobby = $this->request->data['User']['hobby'];
            $email = $this->request->data['User']['email'];
            $password = $this->request->data['User']['password'];
            $image = $this->request->data['User']['image'];

            $data = array(
                    'name' => $name,
                    'gender' => $gender,
                    'birthdate' => $birthdate,
                    'hobby' => $hobby,
                    'email' => $email,
                    'password' => $password,
                    'image' => $image,
                );

            // var_dump(($this->request->data));
            // die();
            
            // Attempt to save the updated user data
            if ($this->User->save($data)) {
                // $this->User->id = $id;
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
    public function delete($id) {

        $this->User->id = $id;

        if($this->request->is(array('post', 'put', 'delete'))) {
            if($this->User->delete()) {
                $this->Session->setFlash('The message has been deleted!');
                $this->redirect('index');
            }
        }
    }

    public function logout() {
        // $this->Auth->logout();
        // $this->redirect($this->Auth->logoutRedirect());
        $this->redirect($this->Auth->logout());
    }

    // public function view_chat($user_id) {
    //     // Set the current user's ID
    //     $currentUserId = $this->Auth->user('id');
    //     $this->set('currentUserId', $currentUserId);
    
    //     // Load the chat messages
    //     $this->loadModel('Message'); // Load the Message model if not already loaded
    //     $this->Message->recursive = -1; // Load messages without related data
    //     $this->set('messages', $this->Message->getChatMessages($user_id, $currentUserId));
    // }

    
}// end of class UserController

?>