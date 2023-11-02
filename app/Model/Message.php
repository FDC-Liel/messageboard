<?php

class Message extends AppModel {

    public $useTable = 'messages';
    public $displayField = 'message';

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
