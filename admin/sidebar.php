<div class="col-md-2 sidebar">
    <div class="row">
        <!-- uncomment code for absolute positioning tweek see top comment in css -->
        <div class="absolute-wrapper"> </div>
        <!-- Menu -->
        <div class="side-menu">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Main Menu -->
                <div class="side-menu-container">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span>
                                Dashboard</a></li>
                        <!-- Dropdown-->
                        <li class="panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#slider">
                                <span class="glyphicon glyphicon-user"></span> Slider <span class="caret"></span>
                            </a>

                            <!-- Dropdown level 1 -->
                            <div id="slider" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="<?=URL . 'admin/slider/create.php'?>">Create</a>
                                        </li>
                                        <li><a href="<?=URL . "admin/slider/index.php"?>">Index</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Dropdown-->
                        <li class="panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#activity">
                                <span class="glyphicon glyphicon-user"></span> User <span class="caret"></span>
                            </a>

                            <!-- Dropdown level 1 -->
                            <div id="activity" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="<?=URL . 'admin/User/create.php'?>">Create</a>
                                        </li>
                                        <li><a href="<?=URL . "admin/User/index.php"?>">Index</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-lvl1">
                                <span class="glyphicon glyphicon-user"></span> Tour Package <span class="caret"></span>
                            </a>

                            <!-- Dropdown level 1 -->
                            <div id="dropdown-lvl1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="<?=URL . 'admin/packages/create.php'?>">Create</a>
                                        </li>
                                        <li><a href="<?=URL . 'admin/packages/index.php'?>">Index</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Dropdown-->
                        <li class="panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#slider">
                                <span class="glyphicon glyphicon-user"></span> Slider <span class="caret"></span>
                            </a>

                            <!-- Dropdown level 1 -->
                            <div id="slider" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li><a href="<?=URL . 'admin/slider/create.php'?>">Create</a>
                                        </li>
                                        <li><a href="<?=URL . "admin/slider/index.php"?>">Index</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li><a href="<?=URL . "admin/logout.php"?>"><span class="glyphicon glyphicon-signal"></span>
                                Logout</a></li>

                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>

        </div>
    </div>
</div>