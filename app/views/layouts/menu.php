<?php
use App\Models\Users;
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" style="font-size: 30px" href="<?=GROOT?>">
                <span>MVC•</span>Pilot
            </a>
            <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand" >
                        <a>MVC•Pilot</a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item p-0">
                    <a class="nav-link" rel="tooltip" title="Login" data-placement="bottom" href="<?=GROOT?>login">
                        <i class="fas fa-sign-in-alt" style="font-size: 30px"></i>
                        <p class="d-lg-none d-xl-none">Login</p>
                    </a>
                </li>
                <li class="nav-item p-0">
                    <a class="nav-link" rel="tooltip" title="Register" data-placement="bottom" href="<?=GROOT?>register">
                        <i class="fas fa-user-plus" style="font-size: 30px"></i>
                        <p class="d-lg-none d-xl-none">Register</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>