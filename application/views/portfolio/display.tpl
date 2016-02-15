{extends file="../layout/index.tpl"}
{block name=content}
    <section class="wrapper clearfix">
        <div class="wrapper__inner">
            <h5 class="wrapper__title">Profile</h5>
            <section class="wrapper__left">
                <img src="{Kohana::$base_url}Uploads/Photo/{$user->id}/{$user->avatar}" alt="" style="max-width:257px;max-height:400px;">
                <a class="wrapper__btn" href="/portfolio/userConfig/">Configuration</a>
                <a class="wrapper__btn remove" href="#" data-id="{$user->id}">Remove Account</a>
            </section>
            <section class="wrapper__right">
                <form id="userDataForm" class="form" action="/{Route::get('pages')->uri(['controller'=>'Portfolio','action'=>'saveData'])}" method="POST" enctype="multipart/form-data">
                    <div class="form__head">
                        <span class="btn">Member picture</span>
                        <span class="btn btn_orange"><input type="file" name="photo" class="form-control" /></span>
                    </div>
                    {*<label class="form-item">
                        <span class="form-item__title">Nickname</span>
                        <input class="form-item__input" type="text" name="nickname" value="{$user->nickname}" placeholder="Enter your nickname">
                    </label>*}
                    <label class="form-item">
                        <span class="form-item__title">Real name</span>
                        <input class="form-item__input" type="text" name="fio" value="{$user->fio}" placeholder="Enter your real name">
                    </label>
                    <div class="form-item">
                        <span class="form-item__title">Gender</span>
                    <span class="form-item__control">

                        {if 1 eq $user->gender} {assign var=male value='checked'}
                        {else}{assign var=male value=''} {assign var=female value='checked'} {/if}

                        <label class="check-box">
                            <input class="check-box__el" name="gender" type="radio" value="1" {$male}>
                            <i class="check-box__img"></i>
                            <span class="check-box__text">Male</span>
                        </label>
                        <label class="check-box">
                            <input class="check-box__el" name="gender" type="radio" value="0" {$female}>
                            <i class="check-box__img"></i>
                            <span class="check-box__text">Female</span>
                        </label>
                    </span>
                    </div>
                    <label class="form-item">
                        <span class="form-item__title">E-mail</span>
                        <input class="form-item__input" type="text" name="email" value="{$user->email}" placeholder="Enter your e-mail">
                        <label class="check-box">
                            <input class="check-box__el" name="mail" type="checkbox" value="Female">
                        </label>
                    </label>
                    {*<label class="form-item">
                        <span class="form-item__title">Website</span>
                        <input class="form-item__input" type="text" name="website" value="{$user->website}" placeholder="Enter your website adress">
                    </label>*}

                    <label class="form-item">
                        <span class="form-item__title">Birthday</span>
                    <span class="form-item__control form-item__control_table">
                        <div class="form-item__born">
                            <div class="form-item__date">
                                <select data-placeholder="Day" name = "day" class="select__date js-select">
                                    {foreach $birth_dates->day as $key => $item name='newItems'}

                                        {if $item eq $current_dates->day}
                                            {assign var=issel value='selected'}
                                        {else}
                                            {assign var=issel value=''}
                                        {/if}

                                        <option value="{$item}" {$issel}>{$item}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="form-item__date">
                                <select data-placeholder="Month" name = "month" class="select__date js-select">
                                    {foreach $birth_dates->month as $key => $item name='newItems'}

                                        {if $item eq $current_dates->month}
                                            {assign var=issel value='selected'}
                                        {else}
                                            {assign var=issel value=''}
                                        {/if}

                                        <option value="{$key}" {$issel}>{$item}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="form-item__date">
                                <select data-placeholder="Year" name = "year" class="select__date js-select">
                                    {foreach $birth_dates->year as $key => $item name='newItems'}

                                        {if $item eq $current_dates->year}
                                            {assign var=issel value='selected'}
                                        {else}
                                            {assign var=issel value=''}
                                        {/if}

                                        <option value="{$item}" {$issel}>{$item}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                    </span>

                    </label>
                    <label class="form-item">
                        <span class="form-item__title">Additional information about yourself</span>
                        <textarea class="form-item__input form-item_about" name="additional" placeholder="Enter additional information about yourself">{$user->additional}</textarea>
                    </label>
                    {*<label class="form-item">
                        <span class="form-item__title">Date of registration: <i class="form-item__title__date">{$user->date_register}</i></span>
                    </label>*}
                    <div class="wrapper__save">
                        <button type="submit" class="wrapper__btn ">Save</button>
                    </div>
                </form>
            </section>

        </div>
    </section>
{/block}

{block name="jscode"}
{/block}



