<div class="container">
    <div id="body">
        <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } else if($this->session->flashdata('error')){  ?>        
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>        
        <?php } ?>
        <form class="form-signin" action="<?php echo base_url()."user/registerUser"?>" method="post" autocomplete="off">    
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
                <p><small>* All fields are mandatory</small></p>
            </div>
            <div id="error" class="error"></div>

            <div class="form-label-group">
                <input type="text" id="inputUsername" name="inputUsername" value="<?php echo set_value('inputUsername'); ?>" class="form-control" placeholder="Username" title="Username must not be blank and contain only letters, numbers and underscores. Lenght should be between 6 to 15 characters" pattern="[A-Za-z0-9_]{6,15}" minlength="6" autocomplete="new-user" required autofocus>
                <label for="inputUsername">Username</label>
                <span id="usernameerror" class="error"></span>
            </div>
            
            <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" value="<?php echo set_value('inputEmail'); ?>" class="form-control" placeholder="Email address" autocomplete="off" required>
                <label for="inputEmail">Email address</label>
                <span id="emailerror" class="error"></span>
            </div>
            
            <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" value="<?php echo set_value('inputPassword'); ?>" class="form-control" placeholder="Password" title="Password must contain: Minimum 8 characters atleast 1 Alphabet and 1 Number" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" minlength="8" autocomplete="new-password" required>
                <label for="inputPassword">Password</label>
                <span id="passworderror" class="error"></span>
            </div>
            
            <div class="form-label-group">
                <input type="number" id="inputAge" name="inputAge" value="<?php echo set_value('inputAge'); ?>" class="form-control" placeholder="Age" min="18" required>
                <label for="inputAge">Age</label>
                <span id="ageerror" class="error"></span>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputCity" name="inputCity" value="<?php echo set_value('inputCity'); ?>" class="form-control" placeholder="City" required>
                <label for="inputCity">City</label>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputPostcode" name="inputPostcode" value="<?php echo set_value('inputPostcode'); ?>" class="form-control" placeholder="XX-XXX" title="XX-XXX" pattern="^[A-Za-z0-9]{2}-[A-Za-z0-9]{3}$" maxlength="6" required>
                <label for="inputPostcode">Post Code</label>
                <span id="postcodeerror" class="error"></span>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputAddress" name="inputAddress" value="<?php echo set_value('inputAddress'); ?>" class="form-control" placeholder="Address" required>
                <label for="inputAddress">Address</label>
            </div>
            
            <button class="btn btn-lg btn-primary btn-block" id="btnRegisterUpdate">Register</button>
        </form>
    </div>
</div>
