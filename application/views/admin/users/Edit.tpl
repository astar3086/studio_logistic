{extends file="../../layout/System/frame.tpl"}
{block name="js"}

{/block}
{block name=content}

    <div class="row">
    <!-- left column -->
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Edit User</h3>
        </div><!-- /.box-header -->
    </div><!-- /.box -->

    <!-- Form Element sizes -->
    <div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Основные поля</h3>
    </div>
    <form role="form" id="editForm" action="{Url::get('SystemRoute','Users','Edit')}/{$data->iduser}/" method="POST">
    <div class="box-body">
        <div class="form-group">
            <label for="" class="required">
                FIO
            </label>
            <input type="text" value="{$data->first_name}" class="form-control" name="first_name" id="first_name">
            <div class="errorMessage" id="fio_em_" style=""></div>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Email
            </label>
            <input type="text" value="{$data->email}" class="form-control" name="email" id="email">
            <div class="errorMessage" id="email_em_" style=""></div>
        </div>

        <div class="form-group">
            <label for="" class="required">
                Status
            </label>
            <input type="text" value="{$data->access_level}" class="form-control" name="access_level" id="access_level">
            <div class="errorMessage" id="access_level_em_" style=""></div>
        </div>

        <div class="form-group">
            <label for="" class="required">
                New Password
            </label>
            <input type="text" value="" class="form-control" name="pass" id="pass">
            <div class="errorMessage" id="access_level_em_" style=""></div>
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