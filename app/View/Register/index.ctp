<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center">Registration Page</h1>

            <?php
            // Display custom errors at the top of the form
            if (!empty($customErrors)) {
                echo '<div class="alert alert-danger">';
                echo 'Please correct the following errors:';
                echo '<ul>';
                foreach ($customErrors as $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        echo '<li>' . h($error) . '</li>';
                    }
                }
                echo '</ul>';
                echo '</div>';
            }

            // Render the form
            echo $this->Form->create('User', ['class' => 'form']);
            echo $this->Form->input('name', ['class' => 'form-control']);
            echo $this->Form->input('email', ['class' => 'form-control']);
            echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control']);
            echo $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control']);
            echo $this->Form->end('Register');
            ?>
        </div>
    </div>
</div>
