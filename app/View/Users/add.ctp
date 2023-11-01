

<h1>Add User</h1>

<?php

    echo $this->Form->create('User');
    echo $this->Form->input('firstname');
    echo $this->Form->input('lastname');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->end('Submit');
?>