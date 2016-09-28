<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role', array(
			'options' => array('admin' => 'Admin', 'user' => 'User')
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Data'), array('controller' => 'data', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data'), array('controller' => 'data', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Chat Room'), array('controller' => 'data', 'action' => 'room')); ?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('action' => 'logout')); ?> </li>
	</ul>
</div>
