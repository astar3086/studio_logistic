<div class="panel panel-default">
    <div class="panel-heading">

        <div class="panel-body" style="float:left;">
            <img src="{Kohana::$base_url}Uploads/Photo/{$user->id}/thumbnail/{$user->photo}">
        </div>

        <div class="panel-body">
            {$item->sendtime}
        </div>


        <h3 class="panel-title"><strong>{$user->fio} Sad:</strong></h3>
    </div>
    <div class="panel-body">
        {$item->message|truncate:300}
    </div>
</div>