<?php /* Smarty version Smarty-3.1.11, created on 2012-09-05 20:35:45
         compiled from "/Users/Waleed/Sites/m/application/views/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7278490555047efe1f32228-45323702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '766cf4412e7da1c9388b15689b49bf74f9cf66d4' => 
    array (
      0 => '/Users/Waleed/Sites/m/application/views/index/index.tpl',
      1 => 1346853330,
      2 => 'file',
    ),
    '21864cc2f7c4d4f007e86c07fb7b9eae7729043f' => 
    array (
      0 => '/Users/Waleed/Sites/m/application/views/layout.tpl',
      1 => 1346763631,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7278490555047efe1f32228-45323702',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5047efe20fe852_20231682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5047efe20fe852_20231682')) {function content_5047efe20fe852_20231682($_smarty_tpl) {?><!DOCTYPE html>
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
        
    <div class="column column-1">
        <h1>Latest Downloads</h1>
        <?php if ($_smarty_tpl->tpl_vars['builds']->value){?>
            <table>
                <thead>
                    <tr>
                        <th>Cards</th>
                        <th>Time</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  $_smarty_tpl->tpl_vars["build"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["build"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['builds']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["build"]->key => $_smarty_tpl->tpl_vars["build"]->value){
$_smarty_tpl->tpl_vars["build"]->_loop = true;
?>
                        <tr>
                            <td class="cards">
                                <?php echo $_smarty_tpl->tpl_vars['build']->value->num;?>

                            </td>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['build']->value->name;?>

                            </td>
                            <td>
                                <a href="<?php echo @APP_URL;?>
builds/download/<?php echo $_smarty_tpl->tpl_vars['build']->value->id;?>
/">
                                    Download
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            No builds yet.
        <?php }?>
    </div>
    <div class="column column-2">
        <h1>Issues</h1>
        <p>
            Is the current list out of date?
            <a
                href="<?php echo @APP_URL;?>
builds/request/"
            >Request a rebuild</a>.

            <span class="progress">
                <span class="bar" style="width: <?php echo $_smarty_tpl->tpl_vars['request_percent']->value*100;?>
%;"></span>
                <span class="caption">Rebuild status</span>
            </span>
        </p>
        <h1>Contact</h1>
        <p>
            <form action="<?php echo @APP_URL;?>
message/" method="post">
                <fieldset>
                    <?php if ($_smarty_tpl->tpl_vars['sent']->value){?>
                        Your message has been sent!
                    <?php }else{ ?>
                        <textarea
                            name="message"
                            rows="5"
                            cols="30"
                        ></textarea>
                        <input type="submit" value="Send" />
                    <?php }?>
                </fieldset>
            </form>
        </p>
    </div>
    <div class="clearfix"></div>

    </div>
</body>
</html>
<?php }} ?>