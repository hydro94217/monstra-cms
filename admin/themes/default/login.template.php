<?php  if ( ! defined('MONSTRA_ACCESS')) exit('No direct script access allowed'); ?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Monstra :: <?php echo __('Administration', 'system'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Monstra Admin Area">
        <link rel="icon" href="<?php echo Option::get('siteurl'); ?>/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo Option::get('siteurl'); ?>/favicon.ico" type="image/x-icon" />

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo Site::url(); ?>/public/assets/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo Site::url(); ?>/public/assets/css/messenger.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo Site::url(); ?>/public/assets/css/messenger-theme-flat.css" type="text/css" />
        <?php Stylesheet::add('public/assets/css/bootstrap-lightbox.css', 'backend', 2); ?>
        <?php Stylesheet::add('public/assets/css/bootstrap-fileupload.css', 'backend', 3); ?>
        <?php Stylesheet::add('admin/themes/default/css/default.css', 'backend', 5); ?>
        <?php Stylesheet::load(); ?>

        <!-- JavaScripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?php echo Site::url(); ?>/public/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo Site::url(); ?>/public/assets/js/messenger.min.js"></script>
        <script src="<?php echo Site::url(); ?>/public/assets/js/messenger-theme-flat.js"></script>
        
        <?php Javascript::add('public/assets/js/bootstrap-lightbox.js', 'backend', 3); ?>
        <?php Javascript::add('public/assets/js/bootstrap-fileupload.js', 'backend', 4); ?>
        <?php Javascript::add('admin/themes/default/js/default.js', 'backend', 5); ?>
        <?php Javascript::load(); ?>

        <script type="text/javascript">
            $().ready(function () {
                <?php if (Notification::get('reset_password') == 'reset_password') { ?>
                    $('.reset-password-area, .administration-btn').show();
                    $('.administration-area, .reset-password-btn').hide();
                <?php } else { ?>
                    $('.reset-password-area, .administration-btn').hide();
                    $('.administration-area, .reset-password-btn').show();
                <?php } ?>

                $('.reset-password-btn').click(function() {
                    $('.reset-password-area, .administration-btn').show();
                    $('.administration-area, .reset-password-btn').hide();
                });

                $('.administration-btn').click(function() {
                    $('.reset-password-area, .administration-btn').hide();
                    $('.administration-area, .reset-password-btn').show();
                });
            });
        </script>

        <?php Action::run('admin_header'); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
    </head>
    <body class="login-body">

        <div class="container form-signin">

            <div style="text-align:center;"><a class="brand" href="<?php echo Option::get('siteurl'); ?>/admin"><img src="<?php echo Option::get('siteurl'); ?>/public/assets/img/monstra-logo.png" height="27" width="171" alt="monstra" /></a></div>
            <div class="administration-area">
                <hr>
                <div>
                    <h2 class="text-center"><?php echo __('Administration', 'system'); ?></h2><br>
                    <form method="post">
                        <div class="form-group">
                            <label><?php echo __('Username', 'users'); ?></label>
                            <input class="form-control" name="login" type="text" />
                        </div>
                        <div class="form-group">
                            <label><?php echo __('Password', 'users'); ?></label>
                            <input class="form-control" name="password" type="password" />
                        </div>
                        <div class="form-group">    
                            <?php if (isset($login_error) && $login_error !== '') { ?><div class="alert alert-error"><?php echo $login_error; ?></div><?php } ?>
                            <input type="submit" name="login_submit" class="btn btn-primary" value="<?php echo __('Log In', 'users'); ?>" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="reset-password-area">
                <hr>
                <div>
                    <h2 style="text-align:center;"><?php echo __('Reset Password', 'users'); ?></h2><br>
                    <?php if (Notification::get('success')) Alert::success(Notification::get('success')); ?>
                    <form method="post">
                        <div class="form-group">
                        <label><?php echo __('Username', 'users'); ?></label>
                        <input name="login" class="form-control" type="text" value="<?php echo $user_login; ?>" />                        
                        </div>
                        <?php if (Option::get('captcha_installed') == 'true') { ?>
                        <div class="form-group">
                        <label><?php echo __('Captcha', 'users'); ?></label>
                        <input type="text" name="answer" class="form-control">
                        <br>
                        <?php CryptCaptcha::draw(); ?>
                        </div>
                        <?php } ?>
                        <br>
                        <?php
                            if (count($errors) > 0) {
                                foreach ($errors as $error) {
                                    Alert::error($error);
                                }
                            }
                        ?>
                        <div class="form-group">
                            <input type="submit" name="reset_password_submit" class="btn btn-primary" value="<?php echo __('Send New Password', 'users')?>" />
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div>
                <div class="text-center">
                    <a class="small-grey-text" href="<?php echo Option::get('siteurl'); ?>"><?php echo __('< Back to Website', 'system');?></a> -
                    <a class="small-grey-text reset-password-btn" href="javascript:;"><?php echo __('Forgot your password? >', 'system');?></a>
                    <a class="small-grey-text administration-btn" href="javascript:;"><?php echo __('Administration >', 'system');?></a>
                </div>
            </div>
        </div>

        <div class="text-center">
            <span class="small-grey-text">© 2012 - 2014 <a href="http://monstra.org" class="small-grey-text" target="_blank">Monstra</a> – <?php echo __('Version', 'system'); ?> <?php echo Monstra::VERSION; ?></span>
        </div>

    </body>
</html>
