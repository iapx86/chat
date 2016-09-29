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
			array(
				'rule' => 'isUnique', //重複禁止
				'message' => '既に存在しています',
			),
			array(
				'rule' => 'alphaNumeric',
				'message' => '半角英数字のみです',
			),
			array(
				'rule' => array('between', 2, 32),
				'message' => '2文字以上32文字以内でお願いします',
			),
		),
		'password' => array(
			array(
				'rule' => 'alphaNumeric',
				'message' => '半角英数字のみです',
			),
			array(
				'rule' => array('between', 4, 32),
				'message' => '4文字以上32文字以内でお願いします',
			),
			array(
				'rule' => 'passwordConfirm',
				'message' => 'パスワードが一致していません'
			),
		),
		'password_confirm' => array(
			array(
				'rule' => 'notBlank',
				'message' => 'パスワード(確認)を入力してください'
			),
		),
		'role' => array(
			array(
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

	public function passwordConfirm($check){
		if($this->data['User']['password'] === $this->data['User']['password_confirm']){
			return true;
		}else{
			return false;
		}
	}
}
