<?php

class MessagesController extends AppController {

    public function index() {   //  app/View/Users/index.ctp
        $data = $this->Message->find('all');       //   QUERY (SELECT ALL)
        $this->set('messages', $data);
    }

    public function add() {     //  app/View/Users/add.ctp

        //post data from form to the database
        if($this->request->is('post')) {        //  POST/INSERT
            $this->Message->create(); //select a table from the database which is the "Users" table to insert data
            if($this->Message->save($this->request->data)) { // true; if data insertion is successful, then redirect to index.ctp
                $this->Session->setFlash('The message has been sent.');
                // $this->redirect('index'); 
            }
        }
        $this->set('users', $this->Message->User->find('list'));
    }

    public function view($id) {     //  app/View/Users/view.ctp
        $data = $this->Message->findById($id);     // VIEW/DISPLAY
        $this->set('message', $data);
    }

    public function chat($user_id) {
        // Get messages for the given user_id
        $messages = $this->Message->find('all', array(
            'conditions' => array('Message.user_id' => $user_id),
            'order' => 'Message.created ASC' // You can adjust the order as needed
        ));
        $this->set('messages', $messages);
    }


}

?>