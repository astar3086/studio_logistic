{extends file="../layout/index.tpl"}
{block name="content"}

    <input type="hidden" value="1"
           name="is_guest_allowed">

<section class="wrapper clearfix">
    <div class="wrapper__inner">

        <div class="col-sm-5">
            <div class="action_status">{$action_status}</div>
        </div>

        <form id="loginForm" method="post" class="form-horizontal" action="/{Route::get('pages')->uri(['controller'=>'auth','action'=>'recovery'])}">
            <input type="hidden" value="{$recovery}" name="recovery">

            <div class="form-group">
                <label class="col-sm-3 control-label">New Password</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" name="pass" />
                    <input type="submit" class="button" name="submit" value="Change Password" />
                </div>
            </div>
        </form>
    </div>
</section>

{/block}

{block name="jscode"}
{/block}