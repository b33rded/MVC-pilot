<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
    <div class="login-form">
        <h2 class="text-center">Sign Up</h2>
        <form action="<?=GROOT?>register" method="POST">
            <div class="form-group">
                <label for="email" class="bmd-label-floating">Email</label>
                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password" class="bmd-label-floating">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="passHelp">
                <small id="passHelp" class="form-text text-muted" >6 characters minimum. Letters and numbers only.</small>
            </div>
            <div class="form-group">
                <label for="confirm" class="bmd-label-floating">Confirm Password</label>
                <input type="password" class="form-control" name="confirm" id="confirm" aria-describedby="confHelp">
                <small id="confHelp" class="form-text text-muted" >Please retype your password.</small>
            </div>
            <div class="error text-center"><?=$this->displayErrors ?></div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
        <p class="text-center small font-weight-bold">Already a member? <a href="<?=GROOT?>login" class="text-decoration-none text-light">Sign in here!</a>.</p>
    </div>
<?php $this->end(); ?>