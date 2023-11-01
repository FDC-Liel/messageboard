

<h1>Compose a message</h1>

<?php

    echo $this->Form->create('Message',);
    echo $this->Form->input('user_id');
    echo $this->Form->input('message');
    echo $this->Form->end('Send Message');
?>