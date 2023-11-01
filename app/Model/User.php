<?php
App::uses('AppModel', 'Model');
App::uses('Security', 'Utility'); // To hash passwords
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 * @property Message $Message
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
public $validate = array(
    'id' => array(
        'notBlank' => array(
            'rule' => array('notBlank'),
        ),
    ),
    'name' => array(
        'notBlank' => array(
            'rule' => array('notBlank'),
        ),
        'minLength' => array(
            'rule' => array('minLength', 5),
            'message' => false,
        ),
    ),
    'email' => array(
        'email' => array(
            'rule' => array('email'),
        ),
        'unique' => array(
            'rule' => 'isUnique',
            'message' => false,
        ),
    ),
    'password' => array(
        'notBlank' => array(
            'rule' => array('notBlank'),
            'message' => false,
        ),
		'minLength' => array(
            'rule' => array('minLength', 8),
            'message' => false,
        ),
    ),
	'confirm_password' => array(
        'compare' => array(
            'rule' => array('comparePasswords', 'password'),
            'message' => false,
        ),
    ),
);



//confirm_password rule
//compare password and confirm_password without hashing
public function comparePasswords($check, $passwordField) {
    $password = $this->data['User'][$passwordField];
    $confirmPassword = $this->data['User']['confirm_password'];

    return $password === $confirmPassword;
}

// hash password before saving
public function beforeSave($options = array()) {
	if (isset($this->data['User']['password'])) {
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
	}
	return true;
}

public function hasCorrectPassword($user, $password) {
    // Retrieve the hashed password from the user data
    $hashedPassword = $user['User']['password'];

    // Use password_verify to compare the provided password with the hashed password
    return password_verify($password, $hashedPassword);
}

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
