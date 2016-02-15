<div class="col-md-4 col-md-content pull-right ">
    {foreach $data as $key => $item name='catalog'}
        <div class="panel panel-default">
            <div class="panel-body">
                <p><strong>Name:</strong> {$item->name}</p>
                <p><strong>Email:</strong> {$item->email}</p>
            </div>
        </div>
    {/foreach}
</div>