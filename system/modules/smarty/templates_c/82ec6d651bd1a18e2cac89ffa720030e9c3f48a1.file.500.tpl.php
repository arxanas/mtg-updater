<?php /* Smarty version Smarty-3.1.11, created on 2013-01-17 10:31:46
         compiled from "/Users/Waleed/Sites/stoneforged/application/views/__errors/500.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158815098650f81952127908-66196830%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82ec6d651bd1a18e2cac89ffa720030e9c3f48a1' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/__errors/500.tpl',
      1 => 1358436706,
      2 => 'file',
    ),
    '019139f68dc3be016722b7ab0ba9af80683356df' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/layout.tpl',
      1 => 1358436558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158815098650f81952127908-66196830',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50f81952206570_25064366',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f81952206570_25064366')) {function content_50f81952206570_25064366($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>500 Internal Server Error</title>

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
    <div class="container">
        <div class="header">
            <div class="login-box">
                <a
                    href="<?php echo @APP_URL;?>
/users/login"
                    class="login-link"
                >log in &rarr;</a>
            </div>

            <h1 class="header-page-title">
                <a
                    href="<?php echo @APP_URL;?>
"
                    class="link-discrete"
                >Stoneforged</a>
            </h1>

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
        <div class="content">
            
Whoops, we messed up: <?php echo $_smarty_tpl->tpl_vars['message']->value;?>


            </div>
        </div>
    </div>
</body>
</html>
<?php }} ?>