<?php
App::uses('AppModel', 'Model');
/**
 * Conversation Model
 *
 */
class Conversation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'conversations';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

    public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'conversation_id'
        )
    );

	public $belongsTo = array(
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id'
        ),
        'Recipient' => array(
            'className' => 'User',
            'foreignKey' => 'recipient_id'
        ),
    );

}