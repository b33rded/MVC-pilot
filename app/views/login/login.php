<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="login-form">
    <h2 class="text-center">Sign In</h2>
    <form action="<?=GROOT?>login" method="POST">
    <div class="form-group">
            <label for="email" class="bmd-label-floating">Login</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password" class="bmd-label-floating">Password</label>
            <input type="password" class="form-control" name="password" id="password" >
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                Remember Me
                <span class="form-check-sign">
              <span class="check"></span>
          </span>
            </label>
        </div>
        <div class="error text-center"><?=$this->displayErrors ?></div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    <p class="text-center small font-weight-bold">Don't have an account? <a href="<?=GROOT?>register" class="text-decoration-none text-light">Sign up here!</a>.</p>
</div>
<?php $this->end(); ?>