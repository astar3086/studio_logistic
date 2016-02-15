{extends file="layout/index.tpl"}
{block name="content"}
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="http-error">
                    <p class="text-center color-lead">
                        {$page->title}
                    </p>

                    <p class="page-description">
                        {$page->description}
                    </p>

                    <p class="page-text">
                        {$page->main_text}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {include file="layout/main/blocks/info_about.tpl"}
    {include file="layout/main/blocks/info_friends.tpl"}

{/block}