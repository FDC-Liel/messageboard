<?php

class MessagesController extends AppController {

    public $helpers = array('Js');
	public $components = array('RequestHandler');

    // public function index() {   //  app/View/Users/index.ctp
    //     $data = $this->Message->find('all');       //   QUERY (SELECT ALL)
    //     $this->set('messages', $data);
    // }

    public function index() {

        $this->loadModel('Conversation');

        // $userId = $this->Session->read('Auth.User.id');
        $userId = $this->Auth->user('id');

        $conversations = $this->Conversation->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Conversation.sender_id' => $userId,
                    'Conversation.recipient_id' => $userId
                )
            ),
            'contain' => array(
                'sender_id', 'recipient_id','created'
            ),
            'limit' => 10,
        ));

        // var_dump($conversations);
        // die();

        $this->set('conversations', $conversations);
    }

    public function loadMore($page = 1) {

        $this->autoRender = false; // Disable view rendering for this action
        $this->loadModel('Conversation');

        if ($this->request->is('ajax')) {
            $page = $this->request->query('page');
            $userId = $this->Session->read('Auth.User.id');
            $perPage = 10; // Number of records per page
        
            // Calculate the offset based on the page number
            $offset = ($page - 1) * $perPage;
        
            // Query for the next set of records
            $conversations = $this->Conversation->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        'Conversation.sender_id' => $userId,
                        'Conversation.recipient_id' => $userId
                    )
                ),
                'contain' => array(
                    'Sender', 'Recipient', 'Conversation'
                ),
                'limit' => $perPage,
                'offset' => $offset
            ));
    
            // Return data as JSON
            echo json_encode($conversations);
        }
    } 

    public function viewMessage($id) {

        $chat_id = $id;
        $this->loadModel('Conversation');

        // Find messages for the specified conversation ID
        $messages = $this->Message->find('all', array(
            'conditions' => array(
                'Message.conversation_id' => $chat_id
            ),
            'order' => array('Message.created ASC'),
            'contain' => 'message', // Load associated user data (if needed)
            'limit' => 10,

        ));

        $this->set('messages', $messages);
        $this->set('conversation_id', $chat_id);
    }
    
    // Load Messages for the pagination fucntionality
    public function loadMoreMessages() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $page = $this->request->data('page');
            $chat_id = $this->request->data('conversationId');
            $offset = ($page - 1) * 10; // Adjust the offset based on the current page
    
            // Find more messages using the same logic as in your 'viewMessage' action
            $messages = $this->Message->find('all', array(
                'conditions' => array(
                    'Messages.conversation_id' => $chat_id
                ),
                'order' => array('Messages.created ASC'),
                'limit' => 10,
                'offset' => $offset
            ));
    
            echo json_encode($messages);
        }
    }

    // Delete Convo all message of sender and recipient
    public function deleteConversation ($id) {
        
        $chat_id = $id;
        $this->loadModel('Conversation');

        $messages = $this->Message->deleteAll(array('Message.conversation_id' => $chat_id), false);

        if ($messages) {
            if ($this->Conversation->delete($chat_id)) {
                $this->redirect(array('controller'=> 'messages', 'action' => 'index'));
            } else {
                $this->redirect(array('controller'=> 'messages', 'action' => 'index'));
            }
        }
    }

    // Delete Single Message
    public function deleteMessage() {
    
      $this->autoRender = false;
      $messageId = isset($this->request->data['id']) ? $this->request->data['id'] : null ;
      
      if (!empty($messageId) && $messageId != null) {
                
            if ($this->Message->delete($messageId)) {
                $response = array('status' => 'success');
                echo json_encode($response);
            }
            else
            {
                $response = array('status' => 'unsuccess');
                echo json_encode($response);
            }
        }

    }
    
    // Delete all message
    public function deleteMessageinConversation() {

        $this->autoRender = false;
        $conversationId = isset($this->request->data['id']) ? $this->request->data['id'] : null ;
        $userId = $this->Session->read('Auth.User.id');

        if (!empty($conversationId) && $conversationId != null) {
            if ($this->Message->deleteAll(array('Message.conversation_id' => $conversationId, 'Message.user_id' => $userId), false)) {
                $response = array('status'=> 'success');
                echo json_encode($response);
            } else {
                $response = array('status'=> 'failed');
                echo json_encode($response);
            }
        }
    }
    

    public function addMessage() {
        $conversationId = isset($this->request->data['id']) ? $this->request->data['id'] : null ; // Chat ID use for the add message in message view

        $this->loadModel('Conversation');

        $userId = $this->Session->read('Auth.User.id');
        
        if (empty($conversationId) && $conversationId == null)
        {
            // Add Message for non existing convo
            if ($this->request->is('post')) {
            
                // Create a Conversation 
                $this->Conversation->create();
                $conversationData = array(
                    'sender_id' => $userId,
                    'recipient_id' => $this->request->data['Message']['recipient_id'],
                    'created' => date('Y-m-d H:i:s')
                );

                if ($this->Conversation->save($conversationData)) {

                    $conversationId = $this->Conversation->id;
                    
                    $this->Message->create();
    
                    $messageData = array(
                        'user_id' => $userId,
                        'message' => $this->request->data['Message']['message'],
                        'created' => date('Y-m-d H:i:s'),
                        'conversation_id' => $conversationId
                    );
                    
                    // Save the created message 
                    if ($this->Message->save($messageData)) {
                        $this->redirect(array('controller'=> 'messages', 'action' => 'index'));
                    } else {
                        $this->redirect(array('controller'=> 'messages', 'action' => 'index'));
                    }

                } else {
                    $this->Flash->success('Something went wrong!', array(
                        'key' => 'error',
                    ));
                    $this->redirect(array('controller'=> 'messages', 'action' => 'index'));
                }
            }
        } else {
            if ($this->request->is('post')) {
                
                $this->autoRender = false;

                $this->Message->create();

                $messageData = array(
                    'user_id' => $userId,
                    'message' => $this->request->data['formData'],
                    'created' => date('Y-m-d H:i:s'),
                    'conversation_id' => $conversationId
                );

                if ($this->Message->save($messageData)) {

                    $lastInsertedId = $this->Message->getLastInsertId();
                    
                    $response = $this->Message->find('first', array(
                        'conditions' => array('Message.id' => $lastInsertedId),
                    ));
                    
                    echo json_encode($response);

                } else {

                }
            } else {
                
            }
        }
       

    }

    public function contactList() {

        $this->loadModel('User');
        $this->autoRender = false;
        
        // Set the data first and check if there is a value if not goes to empty. if there is going to codition to search a user
        $searchTerm = isset($this->request->data['searchTerm']['term']) ? $this->request->data['searchTerm']['term'] : '';

        // finding the data in the table user
        $users = $this->User->find('list', [
            'conditions'=> ['User.name LIKE' => '%'. $searchTerm .'%'],
            'fields' => ['User.id', 'User.name']
        ]);

        // return the data into the view by using the json_encode so it can be use by the select2 api
        $this->response->type('json');
        echo json_encode($users);

    }

    // public function chat($user_id) {
    //     // Get messages for the given user_id
    //     $messages = $this->Message->find('all', array(
    //         'conditions' => array('Message.user_id' => $user_id),
    //         'order' => 'Message.created ASC' // You can adjust the order as needed
    //     ));
    //     $this->set('messages', $messages);
    // }
    
}
?>