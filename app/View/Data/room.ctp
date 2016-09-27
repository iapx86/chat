<?php echo $this->Html->script('http://code.jquery.com/jquery-2.0.0.min.js'); ?>
<?php echo $this->Html->script('room'); ?>
<div class="data form">
	<?php
	echo $this->Form->hidden('user_id' ,array('value' => $user['id']));
	echo $this->Form->input('message');
	?>
	<div id="main">
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
