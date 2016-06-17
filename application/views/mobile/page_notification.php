<div class="pages navbar-fixed">
    <div data-page="notification" class="page">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left">
                    <a href="<?php echo site_url('app') ?>"
                       class="back link icon-only">
                        <i class="icon icon-back"></i>
                    </a>
                </div>
                <div class="center">Notification</div>
                <div class="right">
                    <a href="#" class="link open-panel icon-only">
                        <i class="icon icon-bars"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="page-content infinite-scroll pull-to-refresh-content notif-content" data-distance="50" data-ptr-distance="50">
            <div class="pull-to-refresh-layer">
                <div class="preloader"></div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div class="content-block-title">Notifikasi yang belum dibaca</div>
            <div class="list-block notification-list"
                 data-maxitem="<?php echo $max_item ?>"
                 data-url="<?php echo site_url('app/notification/data') ?>">
                <ul>
                    <?php foreach ($datas['notification'] as $row): ?>
                        <li>
                            <a href="#" class="item-link item-content notification-detail">
                                <div class="item-media"><i class="fa fa-exclamation"></i></div>
                                <div class="item-inner">
                                    <div class="item-title"><?php echo $row['title']?></div>
                                    <div class="item-after"><?php echo $row['date_feed'] ?></div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
