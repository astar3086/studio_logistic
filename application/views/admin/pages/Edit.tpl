{extends file="../../Layout/System/frame.tpl"}
{block name="js"}

{/block}
{block name=content}

    <div class="row">
    <!-- left column -->
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Edit Page</h3>
        </div><!-- /.box-header -->
    </div><!-- /.box -->

    <!-- Form Element sizes -->
    <div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Main Fields</h3>
    </div>
    <form role="form" id="editForm" action="{Url::get('SystemRoute','Pages','EditData')}/{$data->idpages}/" method="POST">
    <div class="box-body">

        <div class="form-group">
            <label for="" class="required">
                Title
            </label>
            <input type="text" value="{$data->title}" class="form-control" name="title" id="title">
            <div class="errorMessage" id="name_em_" style=""></div>
        </div>

        <div class="form-group">
            <label>Page Type</label>
            <select name="page_type" class="form-control">
                <option></option>
                {foreach $PageTypes as $key => $item}
                    {if $data->idpage_type eq $item->idpage_type }
                        {assign var=issel value='selected'}
                    {else}
                        {assign var=issel value=''}
                    {/if}

                    <option value="{$item->idpage_type}" {$issel}>{$item->name}</option>

                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Alias
            </label>
            <input type="text" value="{$data->alias}" class="form-control" name="alias" id="alias">
            <div class="errorMessage" id="name_em_" style=""></div>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Description
            </label>
            <br />
            <textarea cols="80" name="description" id="description" cols="48" rows="10">{$data.description}</textarea>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Text
            </label>
            <br />
            <textarea cols="80" name="main_text" id="main_text" cols="48" rows="10">{$data.main_text}</textarea>
        </div>
    </div><!-- /.box-body -->

        <div class="box-footer">
            <input class="btn btn-primary" type="submit">
            </input>
        </div>
    </form>


    </div><!-- /.box -->
    </div><!--/.col (left) -->
    <!-- right column -->
    </div>
{/block}