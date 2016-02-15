<!DOCTYPE html>
<html>
<head>
    <title>MegaBook - {Request::current()->controller()}</title>
    <link rel="shortcut icon" href="img/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="star" />
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

{include file="layout/System/header.tpl"}

<body class="skin-blue">
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        {include file="layout/System/menu.tpl"}
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
 

        <!-- Main content -->
        <section class="content">

            {block name=content}{/block}

        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->

{include file="layout/System/footer.tpl"}

{block name=jscode}{/block}

