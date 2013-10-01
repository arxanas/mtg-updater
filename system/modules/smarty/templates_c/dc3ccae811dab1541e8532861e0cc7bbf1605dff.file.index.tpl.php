<?php /* Smarty version Smarty-3.1.11, created on 2013-01-18 13:45:13
         compiled from "/Users/Waleed/Sites/stoneforged/application/views/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:682939750f6ba3d8cf1f7-37749728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc3ccae811dab1541e8532861e0cc7bbf1605dff' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/index/index.tpl',
      1 => 1358534711,
      2 => 'file',
    ),
    '019139f68dc3be016722b7ab0ba9af80683356df' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/layout.tpl',
      1 => 1358453831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '682939750f6ba3d8cf1f7-37749728',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50f6ba3d8cff58_49793965',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f6ba3d8cff58_49793965')) {function content_50f6ba3d8cff58_49793965($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Foo</title>

    <link
        rel='stylesheet'
        type='text/css'
        href='http://fonts.googleapis.com/css?family=Montserrat'
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo @APP_URL;?>
/css/stylesheet.css"
    />
    
</head>
<body>
    <div class="container container_12">
        <!-- Page title -->
        <div class="grid_4 suffix_6">
            <h1 class="header-page-title">
                <a
                    href="<?php echo @APP_URL;?>
"
                    class="link-discrete"
                >Stoneforged</a>
            </h1>
        </div>

        <!-- Login box -->
        <div class="grid_2 login-link-box">
            <a
                href="<?php echo @APP_URL;?>
/users/login"
                class="login-link"
            >log in &rarr;</a>
        </div>

        <!-- Navigation bar -->
        <div class="grid_12">
            <ul class="tabs">
                <li class="tab">
                    <a
                        href="<?php echo @APP_URL;?>
/decks/"
                        class="tab-link link-discrete"
                    >Decks</a>
                </li>
                <li class="tab">
                    <a
                        href="<?php echo @APP_URL;?>
/drafts/"
                        class="tab-link link-discrete"
                    >Drafts</a>
                </li>
                <li class="tab">
                    <a
                        href="<?php echo @APP_URL;?>
/games/"
                        class="tab-link link-discrete"
                    >Games</a>
                </li>
                <li class="tab">
                    <a
                        href="<?php echo @APP_URL;?>
/tournaments/"
                        class="tab-link link-discrete"
                    >Tournaments</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container container_12">
        <div class="content container_12">
            
<div class="alpha prefix_1 grid_4">
    Here's some engaging content <a href="#">with a link</a> or two...
</div>

        </div>
    </div>
</body>
</html>
<?php }} ?>