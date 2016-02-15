{extends file="../../layout/System/frame.tpl"}
{block name="js"}
    <script type="text/javascript">

    </script>
{/block}
{block name=content}
    {if $isAdmin}
        <div class="row">
            <div class="col-xs-5">
                <div class="box">
                    <a href="{Url::get('SystemRoute','User','Add')}" class="btn btn-block btn-social btn-github">
                        <i class="fa fa-github"></i> Добавить пользователя
                    </a>
                </div>
            </div>
        </div>

    {else}

        <div class="row">
            <div class="col-xs-5">
                <div class="box">
                    <a href="{Url::get('SystemRoute','User','Add')}" class="btn btn-block btn-social btn-github">
                        <i class="fa fa-github"></i> Модератор
                    </a>
                </div>
            </div>
        </div>

    {/if}

    <!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<table id="userList" class="table table-bordered table-hover">
						<thead>
							<tr>
                                <th>ID</th>
                                <th>FIO</th>
                                <th>Email</th>
                                <th>Статус</th>
								<th></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
                                <th>ID</th>
                                <th>FIO</th>
                                <th>Email</th>
								<th>Статус</th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		
			
				<!-- /.box-header -->
				<div class="box-body table-responsive">
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
    <!-- /.content -->
{/block}