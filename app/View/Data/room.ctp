<?php echo $this->Html->script('http://code.jquery.com/jquery-2.0.0.min.js'); ?>
<?php echo $this->Html->script('room'); ?>
<div class="data form">
	<h2><?php echo __('Chat Room'); ?></h2>
	<?php
	echo $this->Form->hidden('user_id' ,array('value' => $user['id']));
	echo $this->Form->hidden('role' ,array('value' => $user['role']));
	echo $this->Form->input('message');
	?>
	<div id="main">
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<?php if ($user['role'] === 'admin'): ?>
			<li><?php echo $this->Html->link(__('List Data'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('New Data'), array('action' => 'add')); ?></li>
			<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
