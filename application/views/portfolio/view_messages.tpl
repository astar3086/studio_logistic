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
                            <caption>Your messages</caption>
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Message</th>
                            </tr>
                            </thead>
                            <tbody>

                            {foreach $mess as $item name='data'}
                                <tr>
                                    <td>{$item->type}</td>
                                    <td>{$item->message}</td>
                                </tr>
                            {/foreach}

                            </tbody>
                        </table>

                    </div>

                    <div class="caption bordered background-white">
                       <form action="" method="post">
                            <input type="hidden" name="read" id="read" value="1">
                            <input type="submit" value="View All Messages">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

{/block}

{block name="jscode"}
{/block}