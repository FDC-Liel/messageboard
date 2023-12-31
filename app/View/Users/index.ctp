<style>
    /* CSS for the image */
    #profile-image {
        max-width: 300px; /* Set the maximum width */
        max-height: 300px; /* Set the maximum height */
    }
</style>

<div class="card">
    <div class="card-header">
        <h1 class="mt-4">User Profile</h1>
    </div>
    <div class="card-body">
        <div class="row mt-4">
            <!-- User's Image -->
            <?php if ($userData): ?>
            <div class="col-md-3">
                <?php 
                    $img = isset($userData['User']['image']) ? $userData['User']['image'] : 'default-avatar.jpeg';
                    echo $this->Html->image($img, array('alt' => 'Default Avatar',
                        'class' => 'border border-dark mx-auto d-block',
                        'width' => '180',
                        'height' => '180'
                    ));
                ?>
            </div>
            <!-- User's Details -->
            <div class="col-md-9">
                <div class="mb-3">
                    <h4>Name: <span id="name"><?php echo isset($userData['User']['name']) ? $userData['User']['name']:'';?></span></h4>
                </div>
                <div class="mb-3">
                    <h4>Gender: <span id="gender"><?php echo isset($userData['User']['gender']) ? $userData['User']['gender']:'';?></span></h4>
                </div>
                <div class="mb-3">
                    <h4>Birthdate: <span id="birthdate"><?php echo isset($userData['User']['birthdate']) ? $userData['User']['birthdate']:'';?></span></h4>
                </div>
                <div class="mb-3">
                    <h4>Joined: <span id="joined"><?php echo isset($userData['User']['created']) ? $userData['User']['created']:'';?></span></h4>
                </div>
                <div class="mb-3">
                    <h4>Last Login: <span id="last_login"><?php echo isset($userData['User']['last_login_time']) ? $userData['User']['last_login_time']:'';?></span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h4>Hobby:</h4>
            <p><?php echo isset($userData['User']['hobby']) ? $userData['User']['hobby']:'';?></p>
            <?php else: ?>
                <p><strong>No user data available.</strong></p>
            <?php endif; ?> 
        </div>
    </div>
</div>
