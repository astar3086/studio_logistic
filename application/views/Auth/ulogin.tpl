{extends file="../layout/add.tpl"}
{block name="content"}
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-offset-3 col-md-6">
                <div class="thumbnail info-thumbnail background-lead color-white">
                    <div class="caption">
                        <h3><span class="fa fa-user"></span>Continuation Registration</h3>
                        <form role="form" method="post" enctype="multipart/form-data" id="uloginForm" action="/{Route::get('pages')->uri(['controller'=>'Auth','action'=>'continue'])}">
                            <div class="form-group">
                                <label for="InputEmail12">Email address</label>
                                <input name="email" type="email" class="form-control" id="InputEmail12" placeholder="Enter email" value="{$user.email}">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword12">Password</label>
                                <input name="password" required="required" type="password" class="form-control" id="InputPassword12" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="InputPassword2">Re-enter password</label>
                                <input name="password2" required="required" type="password" class="form-control" id="InputPassword2" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="nickname">Nickname<span class="required">*</span></label>
                                <input name="nickname" required="required" type="text" class="form-control" id="nickname" placeholder="Enter your nickname" value="{$user.nickname}">
                            </div>

                            <div class="form-group">
                                <label for="fio">Real name</label>
                                <input name="fio" type="text" class="form-control" id="fio" placeholder="Enter your real name" value="{$user.first_name} {$user.last_name}">
                            </div>

                            <div class="form-group">
                                <label>Sex</label>
                                <br/>
                                <label>Female
                                    <input name="sex" type="radio" class="form-control" value="0">
                                </label>
                                <label>Male
                                    <input name="sex" type="radio" class="form-control" value="1">
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="bdate">Birthday</label>
                                <input name="bdate" type="date" class="form-control" id="bdate" value="{$user.bdate}">
                            </div>

                            {*<div class="form-group">
                                <label for="photo">Avatar</label>
                                <img src="{$user.photo}">
                                <input type="hidden" name="avatar_url" value="{$user.photo}">
                                <a href="javascript:void(0);" id="change_avatar">upload new</a>
                                <input name="photo" type="file" class="form-control" id="photo">
                            </div>*}

                            <button type="submit" class="btn btn-default">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}