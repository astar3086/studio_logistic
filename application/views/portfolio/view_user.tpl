{extends file="../layout/index.tpl"}
{block name=content}
    <input type="hidden" value="{$current_user->id}" name="user_id">
    <input type="hidden" value="{$user->id}" name="profile_id">

    <section class="wrapper clearfix">
        <div class="wrapper__inner">
            <h5 class="wrapper__title">Profile</h5>
            <section class="wrapper__left">
                <img src="{Kohana::$base_url}Uploads/Photo/{$user->id}/{$user->photo}" alt="" style="max-width:257px;max-height:400px;">
                <a class="wrapper__btn toggle" href="#">Complaint to profile</a>

                <div class="attempt"></div>
                <div class="complaint_variant" style="display:none;">
                    <form role="form" id="SubmitForm" action="" >
                        <div class="form-group">
                            <div class="group_button">
                                <select type="sumbit" name="complaint" id = "complaint" class="cat-type">
                                    {foreach $complaints as $item}
                                        <option value="{$item->id}">{$item->complaint}</option>
                                    {/foreach}
                                </select>

                                <input type="hidden" value="{$current_user->id}" name="user_id">
                                <input type="hidden" value="portfolio" name="target_type">
                                <input type="hidden" value="{$user->id}" name="target_id">
                                <input type="button" value="Submit" class="custom_complaint">
                            </div>
                        </div>
                    </form>

                    <a class="toggle_more" href="#">Enter Complaint</a>
                </div>

                <div class="complaint" style="display:none;">
                    <form role="form" id="SubmitForm2" action="" >
                        <div class="form-group">
                            <div class="group_button">
                                <textarea name="reason" class="form-control" style="width:100%;"></textarea>

                                <input type="hidden" value="{$current_user->id}" name="user_id">
                                <input type="hidden" value="portfolio" name="target_type">
                                <input type="hidden" value="{$user->id}" name="target_id">
                                <input type="button" value="Submit" class="reason_sub">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="wrapper__right">
                    <label class="form-item">
                    <span class="form-item__title">Nickname</span>
                    <div class="info">{$user->nickname}</div>
                </label>
                    <label class="form-item">
                        <span class="form-item__title">Real name</span>
                        <div class="info">{$user->fio}</div>
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
                        <div class="info">{$user->email}</div>
                        <label class="check-box">
                            <input class="check-box__el" name="mail" type="checkbox" value="Female">
                        </label>
                    </label>
                    <label class="form-item">
                        <span class="form-item__title">Website</span>
                        <div class="info">{$user->website}</div>
                    </label>
                    <div class="form-item">
                        <span class="form-item__title">Location</span>
                        <label class="form-item__control form-item__control_table">
                        <span class="form-item__col">
                            Country
                        </span>
                        <span class="form-item__col form-item__col_big">

                                {foreach $countries as $key => $item name='newItems'}

                                    {if $item->code eq $user->country}
                                        <div class="info">{$item->name}</div>
                                    {/if}

                                {/foreach}

                        </span>
                        </label>
                        <label class="form-item__control form-item__control_table">
                        <span class="form-item__col">
                            Town
                        </span>
                        <span class="form-item__col form-item__col_big">
                            <div class="info">{$user->city}</div>
                        </span>
                        </label>
                    </div>

                    <label class="form-item">
                        <span class="form-item__title">Birthday</span>
                    <span class="form-item__control form-item__control_table">
                        <div class="form-item__born">
                            <div class="form-item__date">
                                    {foreach $birth_dates->day as $key => $item name='newItems'}

                                        {if $item eq $current_dates->day}
                                        <div class="info">{$current_dates->day}</div>
                                        {/if}

                                    {/foreach}
                            </div>
                            <div class="form-item__date">
                                    {foreach $birth_dates->month as $key => $item name='newItems'}

                                        {if $key eq $current_dates->month}
                                         <div class="info">{$item}</div>
                                        {/if}

                                    {/foreach}
                            </div>
                            <div class="form-item__date">

                                    {foreach $birth_dates->year as $key => $item name='newItems'}

                                        {if $item eq $current_dates->year}
                                         <div class="info">{$current_dates->year}</div>
                                        {/if}

                                    {/foreach}

                            </div>
                        </div>
                    </span>

                    </label>
                    <label class="form-item">
                        <span class="form-item__title">Additional information</span>
                        <div class="info">{$user->additional}</div>
                    </label>
                    <label class="form-item">
                        <span class="form-item__title">Date of registration: <i class="form-item__title__date">{$user->date_register}</i></span>
                    </label>
            </section>

        </div>
    </section>
{/block}

{block name="jscode"}
{/block}



