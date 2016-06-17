<div class="pages navbar-fixed">
    <div data-page="knowledge" class="page">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left">
                    <a href="<?php echo site_url('app') ?>"
                       class="back link icon-only">
                        <i class="icon icon-back"></i>
                    </a>
                </div>
                <div class="center">Pengetahuan</div>
                <div class="right">
                    <a href="#" class="link open-panel icon-only">
                        <i class="icon icon-bars"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="page-content infinite-scroll pull-to-refresh-content knowledge-content" data-distance="50" data-ptr-distance="50">
            <div class="pull-to-refresh-layer">
                <div class="preloader"></div>
                <div class="pull-to-refresh-arrow"></div>
            </div>
            <div class="content-block-title">Daftar pengetahuan</div>
            <div class="list-block media-list knowledge-list"
                 data-maxitem="<?php echo $max_item ?>"
                 data-url="<?php echo site_url('app/knowledge/data') ?>">
                <ul>
                    <?php foreach ($datas['knowledge'] as $row): ?>
                        <li><a href="#" class="item-link item-content show-popup">
                                <div class="item-inner">
                                    <div class="item-title-row">
                                        <div class="item-title"><?php echo $row['title'] ?></div>
                                        <div class="item-after"><?php echo $row['created'] ?></div>
                                    </div>
                                    <div class="item-text"><?php echo $row['content'] ?></div>
                                </div></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
