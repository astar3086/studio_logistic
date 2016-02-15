{extends file="../layout/index.tpl"}
{block name="content"}


<!-- Responsive slider - START -->
<section class="background-white color-black">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 onmap">
                <div class="thumbnail info-thumbnail background-lead color-text">
                    <div class="special background-lead color-white">
                        <h3>
                            <span class="fa fa-user"></span>
                        </h3>
                    </div>

                    <div class="caption bordered background-white">
                        <input type="hidden" name="baseurl" id="baseurl" value="{Kohana::$base_url}">

                        <table class="table" style="width:50%;">
                            <caption><a href="{Kohana::$base_url}portfolio/userConfig/">Configuration List</a></caption>
                            <thead>
                            <tr>
                                <th>Link</th>
                            </tr>

                            </thead>
                            <tbody>

                            <tr>
                                <td colspan="2">
                                    <table class="block_items table">
                                        <tr>
                                            <td>
                                                My Sight Comments
                                            </td>
                                            <td><input type="checkbox" name="config"
                                                       data-id="is_comment_sight_my" {if $data_config->is_comment_sight_my == 1}checked{/if}></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            {*<tr>
                                <td colspan="2">
                                    <p class="pages">{$pagination}</p>
                                </td>
                            </tr>*}

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{/block}

{block name="jscode"}
{/block}