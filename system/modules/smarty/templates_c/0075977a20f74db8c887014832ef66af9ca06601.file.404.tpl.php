<?php /* Smarty version Smarty-3.1.11, created on 2013-04-08 22:50:44
         compiled from "/Users/Waleed/Sites/stoneforged/application/views/__errors/404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200791764850f6bea52dbcf3-30629215%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0075977a20f74db8c887014832ef66af9ca06601' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/__errors/404.tpl',
      1 => 1358376458,
      2 => 'file',
    ),
    '019139f68dc3be016722b7ab0ba9af80683356df' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/layout.tpl',
      1 => 1358453831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200791764850f6bea52dbcf3-30629215',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50f6bea5343864_11198658',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f6bea5343864_11198658')) {function content_50f6bea5343864_11198658($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>404 Not Found</title>

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
            
Well, this is embarrassing.

        </div>
    </div>
</body>
</html>
<?php }} ?>