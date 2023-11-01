<?php

class Message extends AppModel {

    public $belongsTo = array(
        'Conversation' => array(
            'className' => 'Conversations',
            'foreignKey' => 'conversation_id'
        ),
        'User' => array(
            'className' => 'Users',
            'foreignKey' => 'user_id'
        )
    );
}

?>
