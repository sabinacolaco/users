<div id="container">
    <div id="body">
        <form class="form-signin" autocomplete="off">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
            </div>
            <div id="error-msg" class="error"></div>
            <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" autocomplete="new-email" value="<?php if(!empty(get_cookie('loginId'))) { echo get_cookie('loginId'); } ?>" required autofocus>
                <label for="inputEmail">Email address</label>
            </div>
        
            <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" autocomplete="new-password" value="<?php if(!empty(get_cookie('loginPass'))) { echo get_cookie('loginPass'); } ?>" required>
                <label for="inputPassword">Password</label>
            </div>
        
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="rememberMe" id="rememberMe" value="1" <?php if(!empty(get_cookie('loginId'))) { ?> checked="checked" <?php } ?>> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="button" id="btnSubmit">Sign in</button>
            <p class="mt-5 mb-3 text-muted text-center">Not registered? click <a href="<?= base_url('register') ?>">here</a> to Sign Up</p>
        </form>
    </div>
</div>