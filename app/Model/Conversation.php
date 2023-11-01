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
	public $useTable = 'conversation';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public $belongsTo = array(
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id_fk'
        ),
        'Recipient' => array(
            'className' => 'User',
            'foreignKey' => 'recipient_id_fk'
        ),
    );

	public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'convo_id'
        )
    );
}