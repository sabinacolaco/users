<div id="container">
    <div id="body">
        <form class="form-signin" action="<?php echo base_url()."user/EditUser"?>" method="post" autocomplete="off">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Edit User</h1>
            </div>
            <div id="error" class="error"></div>
            
            <div class="form-label-group">
                <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" value="<?=$user['user_name'];?>" required autofocus>
                <label for="inputUsername">Username</label>
            </div>
            
            <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" value="password" required>
                <label for="inputPassword">Password</label>
            </div>
            
            <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" value="<?=$user['user_email'];?>" required>
                <label for="inputEmail">Email address</label>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputAge" name="inputAge" class="form-control" placeholder="Age" value="<?=$user['age'];?>" required>
                <label for="inputAge">Age</label>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputCity" name="inputCity" class="form-control" placeholder="City"  value="<?=$user['city'];?>" required>
                <label for="inputCity">City</label>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputPostcode" name="inputPostcode" class="form-control" placeholder="Postcode" value="<?=$user['post_code'];?>" required>
                <label for="inputPostcode">Postcode</label>
            </div>
            
            <div class="form-label-group">
                <input type="text" id="inputAddress" name="inputAddress" class="form-control" placeholder="Address" value="<?=$user['address'];?>" required>
                <label for="inputAddress">Address</label>
            </div>
            <input type="hidden" id="hdnUserId" name="hdnUserId" value="<?=$user['user_id'];?>">
            
            <button class="btn btn-lg btn-primary btn-block" type="button" id="btnRegisterUpdate">Update</button>
        </form>    
    </div>
</div>
