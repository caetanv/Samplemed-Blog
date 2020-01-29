<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('full_name');
		if(AuthComponent::user('role') == 1){
			echo $this->Form->input('role');
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

	<?php if(AuthComponent::user('role') == 1) :?>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete my account', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('New Topic'), array('controller' => 'topics', 'action' => 'add')); ?> </li>

	<?php endif; ?>

	<?php if(AuthComponent::user('role') != 1) :?>

		<li><?php echo $this->Form->postLink(__('Delete my account'), array('action' => 'delete my account', $this->Form->value('User.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('User.username')))); ?></li>
		<li><?php echo $this->Html->link(__('Create New Topic'), array('controller' => 'topics', 'action' => 'add')); ?> </li>

	<?php endif; ?>
	</ul>
</div>
