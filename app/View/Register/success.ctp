<div class="d-flex justify-content-center">
    <?php
    echo $this->Html->link(
        'Back to Homepage',
        array('controller' => 'users', 'action' => 'login'),
        array('class' => 'btn btn-primary', 'role' => 'button')
    );
    ?>
</div>
