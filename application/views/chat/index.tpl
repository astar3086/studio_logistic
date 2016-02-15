{extends file="../layout/add.tpl"}
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

                            <table class="table" style="width:70%;">
                                <caption>Chat List</caption>
                                <thead>
                                <tr>
                                    <th colspan="2">
                                        View Users
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td colspan="2">
                                        <table class="block_items table">
                                            {foreach $short_history as $item name='sights'}
                                                {if $current_user->id !== $item->sender_id }
                                                    {assign var=current_fio value=$item->sender_fio}
                                                    {assign var=current_id value=$item->sender_id}
                                                    {assign var=current_photo value=$item->sender_photo}
                                                {else}
                                                    {assign var=current_fio value=$item->receiver_fio}
                                                    {assign var=current_id value=$item->receiver_id}
                                                    {assign var=current_photo value=$item->receiver_photo}
                                                {/if}

                                                <tr>
                                                    <td>

                                                        <div class="panel-body">
                                                            <img src="{Kohana::$base_url}Uploads/Photo/{$current_id}/thumbnail/{$current_photo}">
                                                        </div>

                                                        <div class="panel-body">
                                                            <strong>{$current_fio}</strong>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="text">{$item->message|truncate:300}</div>
                                                    </td>
                                                    <td>
                                                        <a href="{Kohana::$base_url}chat/message/{$current_id}">Chat With</a>
                                                    </td>
                                                </tr>
                                            {/foreach}
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