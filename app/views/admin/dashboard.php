<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<body class="">
<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="<?=GROOT?>admin">
                        <i class="tim-icons icon-chart-pie-36"></i>
                        <p>Users</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="<?=GROOT?>admin">Admin</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="search-bar input-group">
                            <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split" ></i>
                                <span class="d-lg-none d-md-block">Search</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">id</th>
                                        <th>Email</th>
                                        <th>User Since</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($this->users as $user): ?>
                                    <tr>
                                        <td class="text-center"><?= $user->id ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->registred_at ?></td>
                                        <td class="td-actions text-right">
                                            <a href="<?=$user->id?>">
                                            <button type="button" rel="tooltip" class="btn btn-info btn-link btn-icon btn-sm">
                                                <i class="tim-icons icon-single-02"></i>
                                            </button>
                                            </a>
                                            <button type="button" rel="tooltip" class="btn btn-success btn-link btn-icon btn-sm">
                                                <i class="tim-icons icon-settings"></i>
                                            </button>
                                            <button type="button" rel="tooltip" class="btn btn-danger btn-link btn-icon btn-sm">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php
                    $currentPage = $this->pages->current();
                    $totalPages = $this->pages->total();
                    ?>
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="<?= $this->pages->route(1) ?>">First</a></li>
                        <li class="page-item <?php if($currentPage <= 1){ echo 'disabled'; }?>">
                            <a class="page-link" href="<?php if($currentPage <= 1){ echo '#'; } else { echo $this->pages->route($currentPage - 1); } ?>">Prev</a>
                        </li>
                        <li class="page-item <?php if($currentPage >= $totalPages){ echo 'disabled'; } ?>">
                            <a class="page-link" href="<?php if($currentPage >= $totalPages){ echo '#'; } else { echo $this->pages->route($currentPage + 1); } ?>">Next</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="<?php echo $this->pages->route($totalPages); ?>">Last</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php $this->end(); ?>
