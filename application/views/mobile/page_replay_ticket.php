<div data-page="replay_ticket" class="page navbar-fixed toolbar-fixed">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left">
                <a href="<?php echo site_url('app') ?>"
                   class="back link icon-only">
                    <i class="icon icon-back"></i>
                </a>
            </div>
            <div class="center">Detail Pengaduan</div>
            <div class="right">
                <a href="#" class="link open-panel icon-only">
                    <i class="icon icon-bars"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="toolbar messagebar" style="">
        <div class="toolbar-inner">
            <textarea name="message" id="message-replay" placeholder="Message" class=""></textarea>
            <a data-name="<?php echo $name ?>" data-id="<?php echo $ticket->uuid ?>" data-url="<?php echo site_url('app/replay_ticket/replay') ?>" href="#" class="link">Send</a>
        </div>
    </div>
    <div class="page-content messages-content" style="">
        <div class="messages messages-auto-layout">
            <div class="messages-date"><?php echo $ticket->date ?></div>
            <div class="message message-received col-100">
                <div class="message-name"><?php echo $ticket->full_name ?></div>
                <div class="message-text">
                    <h4><?php echo $ticket->title ?></h4>
                    <p><?php echo $ticket->question ?></p>
                    <span class="badge bg-green"><?php echo $ticket->status ?></span>
                    <span class="badge bg-orange"><?php echo $ticket->priority ?></span>
                </div>
            </div>
            <?php if($answers): ?>
            <?php foreach ($answers as $answer): ?>
                <div class="messages-date"><?php echo $answer->date ?></div>
            <div class="message message-received">
                <div class="message-name"><?php echo $answer->full_name ?></div>
                <div class="message-text"><?php echo $answer->answer ?></div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>