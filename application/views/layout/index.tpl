{include file="layout/main/header.tpl"}
<body onload="initialize()">
<div id="map_canvas" style="position: absolute; top: 10px; bottom: 0px; left: -80px; right: 0; z-index: 0;"></div>

{include file="layout/main/menu.tpl"}

    {block name=content}{/block}

{include file="layout/main/footer.tpl"}
{block name=jscode}{/block}