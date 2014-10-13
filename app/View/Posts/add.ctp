<h1>Add Post</h1>
<?php
echo $this->Form->create('event');
echo $this->Form->input('title');
echo $this->Form->input('body', array('row' => '3'));
echo $this->Form->end('Save Post');
?>