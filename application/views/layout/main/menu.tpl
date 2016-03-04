    {assign var=c_action value=Request::current()->action()}
    {assign var=c_controller value=Request::current()->controller()}
    {assign var=uri value=$this->request->uri}

    {if $current_user->isGuest() !== true }
        <input type="hidden" value="1" name="is_guest">
    {else}
        <input type="hidden" value="0" name="is_guest">
    {/if}

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="{$base_UI}img/logo.png"></a>
                <ul class="nav navbar-nav navbar-right mobile">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">RUS <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#" class="i18n" data-i18n="ru">RUS </a></li>
                        <li><a href="#" class="i18n" data-i18n="en">ENG </a></li>
                        <li><a href="#" class="i18n" data-i18n="ua">UKR </a></li>
                        <li><a href="#">SPA </a></li>
                      </ul>
                    </li>
                    <li><a href="#" class="loginButton"><img src="{$base_UI}img/user.png"></a></li>
                    <li><a href="#"><img src="{$base_UI}img/setting.png"></a></li>
                </ul>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav big" id="menu">
                    {if $current_user->isGuest() != 1 }
                        <li><a href="#" data-block="1" class="show_sideblock btn_block1  active"><img src="{$base_UI}img/map_icon.png"> {__('Map')}</a></li>
                        <li><a href="#" data-block="2" class="show_sideblock btn_block2"><img src="{$base_UI}img/sputnik.png"> {__('Track')}</a></li>
                        <li><a href="#" data-block="3" id="menu3" class="show_sideblock btn_block3"><img src="{$base_UI}img/book.png"> {__('Directory')}</a></li>
                        <li><a href="#" data-block="4" class="show_sideblock btn_block4"><img src="{$base_UI}img/caculator.png"> {__('Calculator')}</a></li>
                        <li><a href="#" data-block="5" class="show_sideblock btn_block5"><img src="{$base_UI}img/image.png"> {__('Manufacturers')}</a></li>
                        <li><a href="#" data-block="6" class="show_sideblock btn_block6"><img src="{$base_UI}img/study.png"> {__('Training')}</a></li>
                        <!-- <li><a href="#" class="show_sideblock btn_block1  active"><img src="{$base_UI}img/map_icon.png"> Карта</a></li>
                        <li><a href="#" class="show_sideblock btn_block2"><img src="{$base_UI}img/sputnik.png"> Отслеживать</a></li>
                        <li><a href="#" id="menu3" class="show_sideblock btn_block3"><img src="{$base_UI}img/book.png"> Справочник</a></li>
                        <li><a href="#" class="show_sideblock btn_block4"><img src="{$base_UI}img/caculator.png"> Калькулятор</a></li>
                        <li><a href="#" class="show_sideblock btn_block5"><img src="{$base_UI}img/image.png"> Производители</a></li>
                        <li><a href="#" class="show_sideblock btn_block6"><img src="{$base_UI}img/study.png"> Обучение</a></li> -->
                    {/if}
                </ul>
                <ul class="nav navbar-nav navbar-right big">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">RUS <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#" class="i18n" data-i18n="ru">RUS </a></li>
                        <li><a href="#" class="i18n" data-i18n="en">ENG </a></li>
                        <li><a href="#" class="i18n" data-i18n="ua">UKR </a></li>
                        <li><a href="#">SPA </a></li>
                      </ul>
                    </li>
                    <li><a href="#" class="loginButton"><img src="{$base_UI}img/user.png"></a></li>
                    <li><a href="#"><img src="{$base_UI}img/setting.png"></a></li>
                </ul>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" name="search" id="search"><!-- <span class="glyphicon glyphicon-search"></span> -->
                </form>

            </div>

        </div>
    </div>

<div class="log">
    {if $current_user->isGuest() == true }
        <form id="loginForm" method="post" class="form-horizontal" action="/{Route::get('pages')->uri(['controller'=>'Auth','action'=>'login'])}" style="display: none;">
            <div class="form-group">
                <label class="col-sm-3 control-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="email" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-3">
                    <p class="login-button"><button type="submit" class="btn btn-default">Login</button></p>
                    <p class="forgot"><a href="#" class="recovery">Forgot Password</a></p>

                    <div class="email_hid">
                        <div class="attempt"></div>
                        <input type="text" name="email_send" value="" class="form-control">
                        <input type="button" class="recovery_send btn btn-default" value="Recovery" data-action="/{Route::get('pages')->uri(['controller'=>'Auth','action'=>'forgotPassword'])}">
                    </div>

                    <!-- <p class="social-author"><a id="{$uniq_id}" href="#" x-ulogin-params="{$params}" class="btn btn-primary" style="float:center;">
                            <img src="http://ulogin.ru/img/button.png" width=187 height=30 alt="Login with Network"/>
                        </a></p> -->
                </div>
            </div>
        </form>

        <!-- The login modal. Don't display it initially -->
        <form id="registerForm" method="post" class="form-horizontal" action="/{Route::get('pages')->uri(['controller'=>'Auth','action'=>'register'])}" style="display: none;">
            <div class="form-group">
                <div class="col-sm-9">
                    <label for="InputEmail12">{__('Email address')}</label>
                    <input name="email" type="email" class="form-control" id="InputEmail12" placeholder="Enter email" value="">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                    <label for="InputPassword12">{__('Password')}</label>
                    <input name="pass" required="required" type="password" class="form-control" id="InputPassword12" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-9">
                    <label for="InputPassword2">{__('Re-enter password')}</label>
                    <input name="pass2" required="required" type="password" class="form-control" id="InputPassword2" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9">
                    <label for="nickname">{__('Phone')}<span class="required">*</span></label>
                    <input name="phone" required="required" type="text" class="form-control" id="phone" placeholder="Enter your phone" value="">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9">
                    <label for="fio">{__('Real name')}</label>
                    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter your real name" value="">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9">
                    <label>{__('Sex')}</label>
                    <br/>
                    <label>Female
                        <input name="gender" type="radio" class="form-control" value="0">
                    </label>
                    <label>Male
                        <input name="gender" type="radio" class="form-control" value="1">
                    </label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-9">
                    <label for="bdate">{__('Birthday')}</label>
                    <input name="birthday" type="date" class="form-control" id="birthday" value="">
                </div>
            </div>

            <button type="submit" class="btn btn-default">{__('register')}</button>
        </form>
    {/if}
</div>