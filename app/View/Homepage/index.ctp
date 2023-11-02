<div class="container">
        <div class="jumbotron text-center">
            <h1>Welcome to Messageboard</h1>
            <p>Register or Login to access your account.</p>
            <p>
                <a href="<?php echo $this->Html->url(array('controller' => 'register', 'action' => 'index')); ?>"
                   class="btn btn-primary btn-lg">Register</a>
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>"
                   class="btn btn-success btn-lg">Login</a>
            </p>
        </div>
    </div>