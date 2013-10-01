<?php /* Smarty version Smarty-3.1.11, created on 2012-08-31 15:11:25
         compiled from "/Users/Waleed/Sites/ftest/application/views/users/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:469474005504102525395c6-81556921%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1ceb5c6b52087b3878c4fcc5eec814aea3e1233' => 
    array (
      0 => '/Users/Waleed/Sites/ftest/application/views/users/login.tpl',
      1 => 1346440277,
      2 => 'file',
    ),
    'dd59b8474de1fefd9bd6061f66709c4fa2296731' => 
    array (
      0 => '/Users/Waleed/Sites/ftest/application/views/layout.tpl',
      1 => 1346355252,
      2 => 'file',
    ),
    'd0d2eb889519d4629b488507c91b21fe4c4bbd80' => 
    array (
      0 => '/Users/Waleed/Sites/ftest/application/views/top-bar.tpl',
      1 => 1346437653,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '469474005504102525395c6-81556921',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50410252604fb0_92498455',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50410252604fb0_92498455')) {function content_50410252604fb0_92498455($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <title>index &bull; f-Test</title>
    <meta charset="utf-8" />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo @APP_URL;?>
css/reset.css"
    />
    <link
        rel="stylesheet/less"
        type="text/css"
        href="<?php echo @APP_URL;?>
css/stylesheet.less"
    />
    <link
        rel="stylesheet/less"
        type="text/css"
        href="<?php echo @APP_URL;?>
css/forms.less"
    />
    <link
        rel="stylesheet/less"
        type="text/css"
        href="<?php echo @APP_URL;?>
css/posts.less"
    />
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.3.0/less-1.3.0.min.js"
    ></script>
    <script
        src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery-1.8.0.min.js"
    ></script>
    <script src="<?php echo @APP_URL;?>
js/autosubmit.js"></script>
    <script src="<?php echo @APP_URL;?>
js/expanding-textarea.js"></script>
    
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo @APP_URL;?>
css/openid.css"
    />
    <script
        type="text/javascript"
        src="<?php echo @APP_URL;?>
js/openid-jquery.js"
    ></script>
    <script
        type="text/javascript"
        src="<?php echo @APP_URL;?>
js/openid-en.js"
    ></script>
    <script
        type="text/javascript"
        src="<?php echo @APP_URL;?>
js/openid.js"
    ></script>

</head>
<body>

    <div class="container">
        <?php /*  Call merged included template "top-bar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("top-bar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '469474005504102525395c6-81556921');
content_50410c5e02ba29_53690537($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "top-bar.tpl" */?>
        <form action="<?php echo @APP_URL;?>
users/login/" method="post" id="openid_form">
            <input type="hidden" name="action" value="verify" />
            <fieldset>
                <div id="openid_choice">
                    <p>Log in with ...<br /></p>
                    <div id="openid_btns"></div>
                </div>
                <div id="openid_input_area">
                    <input id="openid_identifier" name="openid_identifier" type="text" value="http://" />
                    <input id="openid_submit" type="submit" value="Sign-In"/>
                </div>
                <noscript>
                    <p>OpenID is service that allows you to log-on to many different websites using a single indentity.
                    Find out <a href="http://openid.net/what/">more about OpenID</a> and <a href="http://openid.net/get/">how to get an OpenID enabled account</a>.</p>
                </noscript>
            </fieldset>
        </form>
    </div>

</body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.11, created on 2012-08-31 15:11:26
         compiled from "/Users/Waleed/Sites/ftest/application/views/top-bar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_50410c5e02ba29_53690537')) {function content_50410c5e02ba29_53690537($_smarty_tpl) {?><div class="top-bar">
    <ul>
        <li>
            <a href="<?php echo @APP_URL;?>
users/login/">
                Login
            </a>
        </li>
        <li>Register</li>
    </ul>
</div>
<?php }} ?>