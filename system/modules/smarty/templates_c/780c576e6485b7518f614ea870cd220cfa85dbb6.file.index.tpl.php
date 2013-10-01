<?php /* Smarty version Smarty-3.1.11, created on 2012-08-31 14:27:34
         compiled from "/Users/Waleed/Sites/ftest/application/views/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:404913424503e2e0c2e1b06-04542129%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '780c576e6485b7518f614ea870cd220cfa85dbb6' => 
    array (
      0 => '/Users/Waleed/Sites/ftest/application/views/index/index.tpl',
      1 => 1346436833,
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
  'nocache_hash' => '404913424503e2e0c2e1b06-04542129',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_503e2e0c31d8d5_61894342',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_503e2e0c31d8d5_61894342')) {function content_503e2e0c31d8d5_61894342($_smarty_tpl) {?><!DOCTYPE html>
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
    
</head>
<body>

    <div class="container">
        <?php /*  Call merged included template "top-bar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("top-bar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '404913424503e2e0c2e1b06-04542129');
content_50410216612b27_75389310($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "top-bar.tpl" */?>
        <form action="." method="post">
            <fieldset>
                <div class="control-group">
                    <label
                        class="control-label"
                        for="author"
                    >
                        Author
                    </label>
                    <div class="controls">
                        <input
                            id="author"
                            type="text"
                            name="author"
                            placeholder="anonymous"
                        />
                    </div>
                </div>
                <div class="control-group">
                    <label
                        class="control-label"
                        for="post"
                    >
                        Post
                    </label>
                    <div class="controls">
                        <textarea
                            class="expanding"
                            id="post"
                            name="post"
                            rows="1"
                            cols="10"
                        ></textarea>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="control-group">
                    <div class="controls">
                        <input
                            type="submit"
                            name="submit"
                            value="Post"
                        />
                    </div>
                </div>
            </fieldset>
        </form>
        <table class="post-container">
            <tbody>
        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
                <tr class="post">
                    <td class="author">
                        <?php echo $_smarty_tpl->tpl_vars['post']->value->author;?>

                    </td>
                    <td class="post-content">
                        <?php echo $_smarty_tpl->tpl_vars['post']->value->content;?>

                    </td>
                </tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['post']->_loop) {
?>
            No posts.
        <?php } ?>
            </tbody>
        </table>
        <div class="footer">&nbsp;</div>
    </div>

</body>
</html>
<?php }} ?><?php /* Smarty version Smarty-3.1.11, created on 2012-08-31 14:27:34
         compiled from "/Users/Waleed/Sites/ftest/application/views/top-bar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_50410216612b27_75389310')) {function content_50410216612b27_75389310($_smarty_tpl) {?><div class="top-bar">
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