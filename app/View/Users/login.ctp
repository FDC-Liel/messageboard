<div class="container">
    <h2>Login</h2>
    <?php echo $this->Session->flash(); ?>
    <?php
    // echo $this->Form->create('User', ['class' => 'form-horizontal']);
    echo $this->Form->create();
    echo $this->Form->input('email', ['class' => 'form-control', 'placeholder' => 'Email']);
    echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']);
    echo $this->Form->end('Login', ['class' => 'btn btn-primary']);
    ?>
</div>

<!-- app/View/Login/index.ctp -->
<script>
    if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, ''); // Replace the current page in the browser history
        window.history.forward(1);
    }

    // Handle the back button click (optional)
    window.onpopstate = function (event) {
        if (event.state) {
            // Handle back button click (if needed)
        }
    };
</script>
