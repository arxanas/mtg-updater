<!DOCTYPE html>
<html>
<head>
    <title>{block name="title"}Foo{/block}</title>
    <link
        rel="stylesheet/less"
        type="text/css"
        href="{$smarty.const.APP_URL}css/stylesheet.less"
    />
    <script
        type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.3.0/less-1.3.0.min.js"
    ></script>
    {block name="head"}{/block}
</head>
<body>
    <div class="container">
        {block name="body"}{/block}
    </div>
</body>
</html>
