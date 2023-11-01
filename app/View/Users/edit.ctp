<style>
    /* CSS for the image */
    #profile-image {
        max-width: 300px; /* Set the maximum width */
        max-height: 300px; /* Set the maximum height */
    }
</style>

<div class="card">
    <div class="card-header">
        <h1 class="mt-4">Edit Profile</h1>
    </div>

    <div class="card-body">
        <div class="col-md-3">
            <?php
            if (!empty($userData['User']['image'])) {
                echo $this->Html->image(['controller' => 'users', 'action' => 'displayImage', $userData['User']['id']], ['alt' => 'User Image', 'id' => 'profile-image']);
            } else {
                echo $this->Html->image('default_image.png', ['alt' => 'Default Image', 'id' => 'profile-image']);
            }
            ?>
            <input type="file" id="image" name="data[User][image]" accept=".jpg, .jpeg, .gif, .png" onchange="previewImage()">

        </div>

            <div class="row">
                <div class="col-12">
                <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data')); ?><br>
                </div>
            </div>
            
        <?php echo $this->Form->input('name', array('class' => 'form-control', 'value' => $userData['User']['name'])); ?><br>
        <?php echo $this->Form->input('gender', array('type' => 'radio', 'options' => array('Male' => 'Male', 'Female' => 'Female'), 'value' => $userData['User']['gender'])); ?><br>
        <?php echo $this->Form->input('birthdate', array('label' => 'Birthdate', 'id' => 'birthdate', 'value' => $userData['User']['birthdate'])); ?><br>
        <?php echo $this->Form->input('hobby', array('label' => 'Hobby', 'rows' => '3', 'value' => $userData['User']['hobby'])); ?><br>
        <?php echo $this->Form->input('email', array('label' => 'Email', 'value' => $userData['User']['email'])); ?><br>
        <?php echo $this->Form->end(array('class' => 'btn btn-primary', 'type' => 'submit', 'label' => 'Update')); ?>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function previewImage() {
        const fileInput = document.getElementById('image');
        const profileImage = document.getElementById('profile-image');
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    $(document).ready(function() {
        // Initialize the date picker
        $("#birthdate").datepicker({
            dateFormat: 'dd-mm-yy',  // You can set the desired date format
            changeYear: true,       // Enable year selection
            changeMonth: true       // Enable month selection
        });
    });
</script>