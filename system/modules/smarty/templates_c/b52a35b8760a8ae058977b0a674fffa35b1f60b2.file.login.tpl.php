<?php /* Smarty version Smarty-3.1.11, created on 2013-01-18 14:10:45
         compiled from "/Users/Waleed/Sites/stoneforged/application/views/users/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23621857350f819d2053828-80022777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b52a35b8760a8ae058977b0a674fffa35b1f60b2' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/users/login.tpl',
      1 => 1358535899,
      2 => 'file',
    ),
    '019139f68dc3be016722b7ab0ba9af80683356df' => 
    array (
      0 => '/Users/Waleed/Sites/stoneforged/application/views/layout.tpl',
      1 => 1358453831,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23621857350f819d2053828-80022777',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50f819d211d6a4_66052103',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50f819d211d6a4_66052103')) {function content_50f819d211d6a4_66052103($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Log in</title>

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
            
    <div class="login-box alpha prefix_2 grid_4">
        <h3>Traditional login</h3>
        <form
            action="<?php echo @APP_URL;?>
/users/login/"
            method="post"
        >
            <!-- Email -->
            <div class="control-group">
                <div class="control-label">
                    <label for="email">Email</label>
                </div>
                <div class="controls">
                    <input
                        type="email"
                        name="email"
                        class="input-text"
                        value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8', true);?>
"
                    />
                </div>
            </div>

            <!-- Password -->
            <div class="control-group">
                <div class="control-label">
                    <label for="password">Password</label>
                </div>
                <div class="controls">
                    <input
                        type="password"
                        name="password"
                        class="input-text"
                        value=""
                    />
                </div>
            </div>

            <!-- Login button -->
            <div class="control-group">
                <div class="control-label"></div>
                <div class="controls">
                    <input
                        type="submit"
                        name="submit"
                        class="input-button"
                        value="Log in"
                    />
                </div>
            </div>
        </form>
    </div>
    <div class="login-box grid_4 suffix_2 omega">
        <h3>Log in with OpenID</h3>
        <small>(not yet implemented)</small>
    </div>

        </div>
    </div>
</body>
</html>
<?php }} ?>