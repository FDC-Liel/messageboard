<style>
    /* CSS for the image */
    #profile-image {
        max-width: 300px; /* Set the maximum width */
        max-height: 300px; /* Set the maximum height */
    }
</style>

<div class="card">
    <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'type' => 'file')); ?><br>
    <div class="card-header">
        <h1 class="mt-4">Edit Profile</h1>
    </div>

    <div class="card-body">
        <div class="row d-flex justify-content-center align-item-center">
        <div class="col-md-3">
            <?php
                if (!empty($userData['User']['image'])) {
                    echo $this->Html->image(['controller' => 'users', 'action' => 'displayImage', $userData['User']['id']], ['alt' => 'User Image', 'id' => 'profile-image']);
                } else {
                    echo $this->Html->image('default_image.png', ['alt' => 'Default Image', 'id' => 'profile-image']);
                }

                $image = isset($current_use['image']) ? '../img/' . $current_user['image'] : '';
                // Browse and insert image
                echo $this->Form->input('image', array(
                    'label' => false,
                    'class' => 'dropify',
                    'type' => 'file',
                    'id' => 'image',
                    'data-max-file-size' => '2M',
                    'data-allowed-file-extensions' => array('jpg', 'png', 'gif'),
                    'data-max-file-size-preview' => '2M',
                    'data-default-file' => $image,
                    'value' => $current_user['image'] // Fix the field name
                ));
            ?>
        </div>
        </div>
        
        <?php echo $this->Form->input('name', array('class' => 'form-control', 'value' => $current_user['name'])); ?><br>
        <?php echo $this->Form->input('gender', array('class' => 'form-check-input mx-2', 'type' => 'radio', 'options' => array('Male' => 'Male', 'Female' => 'Female'), 'value' => $current_user['gender'])); ?><br>
        <?php echo $this->Form->input('birthdate', array('class' => 'form-control','id' => 'birthdate', 'value' => $current_user['birthdate'])); ?><br>
        <?php echo $this->Form->input('hobby', array('class' => 'form-control','rows' => '3', 'value' => $current_user['hobby'])); ?><br>
        <?php echo $this->Form->input('email', array('class' => 'form-control', 'value' => $current_user['email'])); ?><br>
        <?php echo $this->Form->input('password', array('class' => 'form-control')); ?><br>
        <?php echo $this->Form->end(array('class' => 'btn btn-primary', 'type' => 'submit', 'label' => 'Update')); ?>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

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

    // Add onchange event to the file input
    document.getElementById('image').onchange = previewImage;

        // Initialize the date picker
        $("#birthdate").datepicker({
            dateFormat: 'mm-dd-yy',  // You can set the desired date format
            changeYear: true,       // Enable year selection
            changeMonth: true       // Enable month selection
        });
        
    });
</script>