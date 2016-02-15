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

                            <form role="form" id="SubmitForm" action="/{Route::get('pages')->uri(['controller'=>'Map','action'=>'AddData'])}" >
                                <table class="table" style="width:70%;">
                                    <caption>Chat List</caption>
                                    <thead>
                                    <tr>
                                        <th colspan="2">
                                            Messages
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td colspan="2">
                                            <table class="block_items table">
                                                    <tr>
                                                        <td>
                                                            <strong>{$item->name}</strong>
                                                            <img src="{Kohana::$base_url}Uploads/Photo/{$receiver->id}/thumbnail/{$receiver->photo}">
                                                            <input type="hidden" name="receiver_id" id="receiver_id" value="{$receiver->id}">
                                                            <input type="hidden" name="session" id="session" value="{$session}">
                                                        </td>
                                                        <td>
                                                            <div class="text">
                                                                <textarea cols="80" name="message" id="message" cols="48" rows="10"></textarea>
                                                            </div>

                                                            <div class="form-group" id="button-form">
                                                                <button class="btn btn-primary" type="button" id="formsub">Send</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            </table>

                                            <div class="panel panel-default messages">
                                                {foreach $short_history as $item name='sights'}
                                                    {assign var=current_fio value=$item->sender_fio}
                                                    {assign var=current_id value=$item->sender_id}
                                                    {assign var=current_photo value=$item->sender_photo}

                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">

                                                            <div class="panel-body" style="float: left;">
                                                                <img src="{Kohana::$base_url}Uploads/Photo/{$current_id}/thumbnail/{$current_photo}">
                                                            </div>

                                                            <div class="panel-body">
                                                                {$item->sendtime}
                                                            </div>

                                                            <h3 class="panel-title">
                                                                <strong>{$current_fio} Sad:</strong>
                                                            </h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            {$item->message|truncate:300}
                                                        </div>
                                                    </div>
                                                {/foreach}
                                            </div>

                                            <div class="form-group" id="button-form">
                                                <button class="btn btn-primary show_full" type="button" >Show All Messages</button>
                                            </div>

                                        </td>
                                    </tr>

                                    {*<tr>
                                        <td colspan="2">
                                            <p class="pages">{$pagination}</p>
                                        </td>
                                    </tr>*}

                                    </tbody>
                                </table>
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