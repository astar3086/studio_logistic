{**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 28.05.2014
 * Time: 15:47
 *}
{extends file="../layout/add.tpl"}
{block name="content"}
<div class="container">
    <h1><span>Registration</span></h1>
    <div class="row">
        <div class="col-sm-12 col-md-offset-3 col-md-6">
            <div class="thumbnail info-thumbnail background-lead color-white">
                <div class="caption">
                    <h3><span class="fa fa-user"></span> Registration</h3>
                    <form role="form" id="registerForm" action="/{Route::get('register')->uri()}">
                        <div class="form-group">
                            <label for="InputName">Name</label>
                            <input name="name" type="text" class="form-control" id="InputName" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="InputEmail12">Email address</label>
                            <input name="email" type="email" class="form-control" id="InputEmail12" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="InputPassword12">Password</label>
                            <input name="password" type="password" class="form-control" id="InputPassword12" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="InputPassword2">Re-enter password</label>
                            <input name="password2" type="password" class="form-control" id="InputPassword2" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="InputCountry">Country</label>
                            <input name="country" type="text" class="form-control" id="InputCountry" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Register</button>
                        <!--span class="color-white"><button type="button" class="btn btn-link pull-right">Login</button></span-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}