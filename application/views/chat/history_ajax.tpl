{foreach $full_history as $item name='sights'}
    {if $sender_id == $item->sender_id }
        {assign var=current_fio value=$item->sender_fio}
        {assign var=current_id value=$item->sender_id}
        {assign var=current_photo value=$item->sender_photo}
    {else}
        {assign var=current_fio value=$item->receiver_fio}
        {assign var=current_id value=$item->receiver_id}
        {assign var=current_photo value=$item->receiver_photo}
    {/if}

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