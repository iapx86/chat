<?php
App::uses('AppController', 'Controller');
/**
 * Data Controller
 *
 * @property Data $Data
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class DataController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Paginator',
		'Session',
		'Flash',
		'Security',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish',
				),
			),
			'authorize' => array('Controller'),
		),
	);

/**
 * beforeFilter method
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
		$this->Security->unlockedActions = array('post');
		$this->Security->blackHoleCallback = 'blackhole';
	}

/**
 * isAuthorized method
 *
 * @return boolean
 */
	public function isAuthorized($user) {
		// 登録済ユーザー
		if ($this->action === 'room' || $this->action === 'get' || $this->action === 'post') {
			return true;
		}
		// 投稿のオーナーは削除ができる
		if ($this->action === 'delete' && $this->Data->isOwnedBy((int)$this->request->params['pass'][0], $user['id'])) {
			return true;
		}
		return parent::isAuthorized($user);
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Data->recursive = 0;
		$this->set('data', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Data->exists($id)) {
			throw new NotFoundException(__('Invalid data'));
		}
		$options = array('conditions' => array('Data.' . $this->Data->primaryKey => $id));
		$this->set('data', $this->Data->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Data->create();
			if ($this->Data->save($this->request->data)) {
				$this->Flash->success(__('The data has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The data could not be saved. Please, try again.'));
			}
		}
		$users = $this->Data->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Data->exists($id)) {
			throw new NotFoundException(__('Invalid data'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Data->save($this->request->data)) {
				$this->Flash->success(__('The data has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The data could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Data.' . $this->Data->primaryKey => $id));
			$this->request->data = $this->Data->find('first', $options);
		}
		$users = $this->Data->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Data->id = $id;
		if (!$this->Data->exists()) {
			throw new NotFoundException(__('Invalid data'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Data->delete()) {
			$this->Flash->success(__('The data has been deleted.'));
		} else {
			$this->Flash->error(__('The data could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * room method
 *
 * @return void
 */
	public function room() {
		$this->set('user', $this->Auth->user());
	}

/**
 * get method
 *
 * @return void
 */
	public function get() {
		if (!$this->request->is('ajax')) {
			return $this->redirect('/');
		}
		$this->viewClass = 'Json';
		$this->set('data', $this->Data->find('all', array('order' => 'Data.created DESC')));
		$this->set('_serialize', 'data');
	}

/**
 * post method
 *
 * @return void
 */
	public function post() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
			$this->Data->create();
			$this->Data->save($this->request->data);
		}
	}

	public function blackhole($type) {
		$this->Session->setFlash('不正なリクエストが行われました');
		$this->redirect(array('controller' => $this->controller, 'action' => $this->action));
	}
}
