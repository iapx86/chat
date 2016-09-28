<div class="data view">
<h2><?php echo __('Data'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($data['Data']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($data['User']['username'], array('controller' => 'users', 'action' => 'view', $data['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($data['Data']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($data['Data']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($data['Data']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Data'), array('action' => 'edit', $data['Data']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Data'), array('action' => 'delete', $data['Data']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $data['Data']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Data'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Data'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Chat Room'), array('action' => 'room')); ?> </li>
		<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
