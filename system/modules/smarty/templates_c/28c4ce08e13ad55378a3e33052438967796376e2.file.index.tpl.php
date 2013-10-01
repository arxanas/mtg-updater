<?php /* Smarty version Smarty-3.1.11, created on 2013-01-29 13:57:59
         compiled from "/Users/Waleed/Sites/twitter/application/views/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1287398335107dbee94f400-99154859%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28c4ce08e13ad55378a3e33052438967796376e2' => 
    array (
      0 => '/Users/Waleed/Sites/twitter/application/views/index/index.tpl',
      1 => 1359471291,
      2 => 'file',
    ),
    '08f9cba278a43295b5aa80ede37bd04f11df41b5' => 
    array (
      0 => '/Users/Waleed/Sites/twitter/application/views/layout.tpl',
      1 => 1359485878,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1287398335107dbee94f400-99154859',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5107dbee9d6ff2_45563287',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5107dbee9d6ff2_45563287')) {function content_5107dbee9d6ff2_45563287($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <title>Twitter</title>
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo @APP_URL;?>
/css/stylesheet.css"
    />
    
</head>
<body>
    <div class="container">
        <div class="nav-bar">
            <ul>
                <li>
                    <a
                        href="<?php echo @APP_URL;?>
/users/login/"
                        class="nav-bar-link"
                    >Log in</a>
                </li>
                <li>
                    <a
                        href="<?php echo @APP_URL;?>
/users/register/"
                        class="nav-bar-link"
                    >Register</a>
                </li>
            </ul>
        </div>
        <div class="content">
            
    Hello, world!

        </div>
    </div>
</body>
</html>
<?php }} ?>