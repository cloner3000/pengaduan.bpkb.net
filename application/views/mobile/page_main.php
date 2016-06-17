<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Pengaduan Online Polda Metro Jaya</title>
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/mobile/css/framework7.material.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/mobile/css/framework7.material.colors.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/mobile/css/kitchen-sink.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/mobile/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="<?php echo base_url(); ?>assets/mobile/css/my-app.css">
</head>
<body>
<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>
<div class="panel panel-left panel-cover">
    <div class="pages navbar-fixed">
        <div data-page="panel-left" class="page">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="center">Menu</div>
                </div>
            </div>
            <div class="page-content">
                <div class="list-block">
                    <ul>
                        <li>
                            <a href="<?php echo site_url('app/auth/view_change_password') ?>"
                               class="item-link close-panel">
                                <div class="item-content">
                                    <div class="item-media"><i
                                            class="fa fa-user"></i></div>
                                    <div class="item-inner">
                                        <div id="nickname"
                                             class="item-title"><?php echo $user['name'] ?></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><a href="<?php echo site_url('app/notification') ?>"
                               class="item-link close-panel">
                                <div class="item-content">
                                    <div class="item-media"><i
                                            class="fa fa-exclamation"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title">Notifikasi</div>
                                        <div class="item-after"><span
                                                class="badge bg-green"><?php echo $notification_unread ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><a href="<?php echo site_url('app/knowledge') ?>" class="item-link close-panel">
                                <div class="item-content">
                                    <div class="item-media"><i
                                            class="fa fa-book"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title">Pengetahuan
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><a href="#"
                               class="item-link close-panel logout-link"
                               data-url="<?php echo site_url('app/auth/logout') ?>">
                                <div class="item-content">
                                    <div class="item-media"><i
                                            class="fa fa-lock"></i></div>
                                    <div class="item-inner">
                                        <div class="item-title">Keluar
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Login-->

<div class="login-screen <?php echo empty($userid) ? 'modal-in' : '' ?>">
    <div class="view">
        <div class="page">
            <div class="page-content login-screen-content">
                <div class="login-screen-title">Pengaduan Online</div>
                <form method="post"
                      action="<?php echo site_url('app/auth/login') ?>"
                      id="form-login" class="ajax-submit">
                    <div class="list-block">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Username</div>
                                    <div class="item-input">
                                        <input type="text" name="username"
                                               placeholder="Your username">
                                    </div>
                                </div>
                            </li>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title label">Password</div>
                                    <div class="item-input">
                                        <input type="password" name="password"
                                               placeholder="Your password">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="content-block">
                        <div class="row">
                            <div class="col-100">
                                <input type="submit" value="Masuk"
                                       class="button button-raised button-fill color-green"/>
                            </div>
                        </div>
                        <div class="list-block-label">
                            <p>untuk menggunakan aplikasi pengaduan online,
                                silahkan login terlebih dahulu</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Views-->
<div class="views">
    <div class="view view-main">
        <div class="pages navbar-fixed">
            <div data-page="main" class="page page-on-center">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="center">Aplikasi Pengaduan Online</div>
                        <div class="right">
                            <a href="#" class="link open-panel icon-only">
                                <i class="icon icon-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <form data-search-list=".search-here"
                      data-search-in=".item-title"
                      class="searchbar searchbar-init">
                    <div class="searchbar-input">
                        <input type="search" placeholder="Search"/>
                        <a href="#" class="searchbar-clear"></a>
                    </div>
                </form>
                <div class="searchbar-overlay"></div>
                <div class="page-content pull-to-refresh-content infinite-scroll main-content" data-distance="50" data-ptr-distance="50">
                    <div class="pull-to-refresh-layer">
                        <div class="preloader"></div>
                        <div class="pull-to-refresh-arrow"></div>
                    </div>
                    <div class="content-block-title">Pengaduan yang masuk</div>
                    <div class="list-block searchbar-not-found pengaduan-list" data-url="<?php echo site_url('app/data') ?>">
                        <ul>
                            <li class="item-content">
                                <div class="item-inner">
                                    <div class="item-title">Nothing found</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="list-block search-here searchbar-found ticket-list"
                         data-maxitem="<?php echo $max_item ?>"
                         data-url="<?php echo site_url('app/data') ?>">
                        <ul>
                            <?php foreach ($datas['ticket'] as $row): ?>
                            <li>
                                <div class="card ks-facebook-card">
                                    <div class="card-header no-border">
                                        <div class="ks-facebook-avatar">
                                            <img
                                                src="<?php echo base_url() ?>/assets/mobile/img/avatar.jpg"
                                                width="34" height="34" class="">
                                        </div>
                                        <div class="ks-facebook-name"><?php echo $row['full_name'] ?></div>
                                        <div class="ks-facebook-date"><?php echo $row['date'] ?></div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-content-inner">
                                            <h4 class="item-title"><?php echo $row['title'] ?></h4>
                                            <p class=""><?php echo $row['question'] ?></p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#">
                                            <span class="badge bg-green"><?php echo $row['status'] ?></span>
                                            <span class="badge bg-deeporange"><?php echo $row['priority'] ?></span>
                                        </a>
                                        <a href="<?php echo site_url('app/replay_ticket/detail/'.$row['uuid'])?>" data-id="<?php echo $row['uuid'] ?>" class="link">Balas</a></div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/mobile/js/framework7.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/mobile/js/my-app.js"></script>
</body>
</html>