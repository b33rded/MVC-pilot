<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<body class="register-page">
    <div class="wrapper">
        <div class="page-header">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3">
                            <div id="square7" class="square square-7"></div>
                            <div id="square8" class="square square-8"></div>
                            <div class="card card-register">
                                <div class="card-header">
                                    <img class="card-img" src="<?=GROOT?>static/img/login/square1.png" alt="Card image">
                                    <h4 class="card-title">Sign In</h4>
                                </div>
                                <div class="card-body">
                                    <div class="error">
                                            <?=$this->displayErrors ?>
                                    </div>
                                    <form class="form" action="<?=GROOT?>login" method="POST">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-single-02"></i>
                                                </div>
                                            </div>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="required">
                                        </div>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tim-icons icon-lock-circle"></i>
                                                </div>
                                            </div>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
                                        </div>
                                        <div class="form-check text-left">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                                Remember Me
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                        <div class="form-group text-left">
                                            <button type="submit" class="btn btn-info btn-round btn-lg form-submit">Login</button>
                                        </div>
                                    </form>
                                    <p class="text-right">Don't have an account? <a href="<?=GROOT?>register" class="text-decoration-none text-light">Sign up here!</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="register-bg"></div>
                    <div id="square1" class="square square-1"></div>
                    <div id="square2" class="square square-2"></div>
                    <div id="square3" class="square square-3"></div>
                    <div id="square4" class="square square-4"></div>
                    <div id="square5" class="square square-5"></div>
                    <div id="square6" class="square square-6"></div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php $this->end(); ?>