<h1> Edit the Post </h1>

<?php
	echo $this->Form->create('Post');
	echo $this->Form->input('body');
	echo $this->Form->end('Edit');
?>