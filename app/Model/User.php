<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Data $Data
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'isUnique' => array(
				'rule' => 'isUnique', //重複禁止
				'message' => '既に存在しています',
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => '半角英数字のみです',
			),
			'valid' => array(
				'rule' => array('between', 2, 32),
				'message' => '2文字以上32文字以内でお願いします',
			),
		),
		'password' => array(
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => '半角英数字のみです',
			),
			'vaild' => array(
				'rule' => array('between', 4, 32),
				'message' => '4文字以上32文字以内でお願いします',
			),
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'user')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false,
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Data' => array(
			'className' => 'Data',
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

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

}
