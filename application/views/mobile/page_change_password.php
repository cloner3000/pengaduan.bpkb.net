<div class="pages navbar-fixed">
    <div data-page="change-password" class="page">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left">
                    <a href="<?php echo site_url('app') ?>" class="back link icon-only">
                        <i class="icon icon-back"></i>
                    </a>
                </div>
                <div class="center">Ubah Password</div>
                <div class="right">
                    <a href="#" class="link open-panel icon-only">
                        <i class="icon icon-bars"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="page-content">
            <form method="post" action="<?php echo site_url('app/auth/action_change_password') ?>" id="form-change-password" class="ajax-submit">
                <div class="list-block inputs-list">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i
                                        class="icon icon-form-email"></i>
                                </div>
                                <div class="item-inner">
                                    <div class="item-title floating-label">
                                        Password Lama
                                    </div>
                                    <div
                                        class="item-input item-input-field">
                                        <input type="password" name="oldpass" placeholder="" class="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i
                                        class="icon icon-form-password"></i>
                                </div>
                                <div class="item-inner">
                                    <div class="item-title floating-label">
                                        Password baru
                                    </div>
                                    <div
                                        class="item-input item-input-field">
                                        <input type="text" name="newpass"
                                               placeholder="">
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-block">
                    <div class="row">
                        <div class="col-100">
                            <input type="submit" value="Perbarui Password" class="button button-raised button-fill color-green"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
