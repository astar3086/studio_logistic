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
            <h3 class="box-title">Add Page</h3>
        </div><!-- /.box-header -->
    </div><!-- /.box -->

    <!-- Form Element sizes -->
    <div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Основные поля</h3>
    </div>
    <form role="form" id="editForm" action="{Url::get('SystemRoute','Pages','AddData')}" method="POST">
    <div class="box-body">

        <div class="form-group">
            <label for="" class="required">
                Title
            </label>
            <input type="text" value="" class="form-control" name="title" id="title">
            <div class="errorMessage" id="title_em_" style=""></div>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Alias
            </label>
            <input type="text" value="" class="form-control" name="alias" id="alias">
            <div class="errorMessage" id="title_em_" style=""></div>
        </div>

        <div class="form-group">
            <label>Page Type</label>
            <select name="page_type" class="form-control">
                <option></option>
                {foreach $PageTypes as $item}
                    <option value="{$item->idpage_type}">{$item->name}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Description
            </label>
            <br />
            <textarea cols="80" name="description" id="description" cols="48" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Text
            </label>
            <br />
            <textarea cols="80" name="main_text" id="main_text" cols="48" rows="10"></textarea>
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