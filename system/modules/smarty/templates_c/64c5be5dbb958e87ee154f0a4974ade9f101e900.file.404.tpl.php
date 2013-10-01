<?php /* Smarty version Smarty-3.1.11, created on 2012-09-05 20:43:36
         compiled from "/Users/Waleed/Sites/m/application/views/__errors/404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9157729675047f06ed23653-76516171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64c5be5dbb958e87ee154f0a4974ade9f101e900' => 
    array (
      0 => '/Users/Waleed/Sites/m/application/views/__errors/404.tpl',
      1 => 1346892095,
      2 => 'file',
    ),
    '21864cc2f7c4d4f007e86c07fb7b9eae7729043f' => 
    array (
      0 => '/Users/Waleed/Sites/m/application/views/layout.tpl',
      1 => 1346763631,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9157729675047f06ed23653-76516171',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5047f06eda91d0_93571936',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5047f06eda91d0_93571936')) {function content_5047f06eda91d0_93571936($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <title>Foo</title>
    <link
        rel="stylesheet/less"
        type="text/css"
        href="<?php echo @APP_URL;?>
css/stylesheet.less"
    />
    <script
        type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.3.0/less-1.3.0.min.js"
    ></script>
    
</head>
<body>
    <div class="container">
        
    <h1>404 Not Found</h1>
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['message']->value)===null||$tmp==='' ? '' : $tmp);?>


    </div>
</body>
</html>
<?php }} ?>