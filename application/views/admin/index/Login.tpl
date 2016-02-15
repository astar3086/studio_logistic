{extends file="layout/System/frame.tpl"}
{block name=content}
<div class="content">
    <div class="row">
        <div class="sight-wrapper">
            <div class="sight-left">
                <div class="sight-description">
                    <p></p>

                    <div class="sight-social">
                        <a class="facebook" href="#"></a>
                        <a class="twitter" href="#"></a>
                        <a class="vk" href="#"></a>
                        <a class="odnclass" href="#"></a>
                        <a class="google" href="#"></a>
                        <a class="pencil" href="#"></a>
                    </div>
                    <div style="clear:both;"></div>

                </div>
                <div class="sight-reviews">
                    <div class="sr-header">
                        <span>Admin Panel</span>
                    </div>

                    <div class="box-body" style="margin-top:20px;">
                        <form id="submitForm" action="/{Route::get('SystemRoute')->uri(['controller'=>'Main','action'=>'login'])}" method="POST">
                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="email" value="" class="form-control">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->


                            <div class="form-group">
                                <label>Password:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <input type="text" name="pass" value="" class="form-control" />
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->
                            <button type="submit" class="btn btn-success">Login</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {/block}



