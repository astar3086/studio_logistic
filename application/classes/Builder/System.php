<?php
namespace Builder;
use Utils\Url;
use Assets;
use Controller;
use Request;

class System extends \Controller
{
    /**
     * @var \Smarty
     */
    protected $template;

    /**
     *
     */
    public function before()
    {

        if( \Registry::getCurrentUser()->isGuest() )
        {
            if (  $this->request->controller() != 'Main' &&
                $this->request->action() != 'login' ){

                #todo Fix it!
                if ( !\Request::current()->is_ajax() /*OR $this->request !== \Request::*/){

                    \HTTP::redirect(\Route::get('SystemRoute')->uri(['controller'=>'Main','action'=>'login']), 302);

                }
            }

        }


        if(!Request::current()->is_ajax())
        {
            // Add Google Font
            Assets::css('Google_Font','http://fonts.googleapis.com/css?family=Lato:100,300,400,700,300italic,400italic,700italic|Lustria');
            Assets::js('jQuery',base_UI.'libs/jquery-2.1.1.js');

            Assets::css('bootstrap', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', ['media' => 'screen']);
            Assets::js('bootstrap', 'http:////netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js');
            Assets::css('font-awesome', 'http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', ['media' => 'screen']);
            /*Базовые стили шаблона*/

            Assets::css('stl',base_UI.'AdminLTE/css/style.css');
            Assets::css('lightbox', base_UI.'libs/lightbox/css/lightbox.css');

            /*BootBox Js file*/
            Assets::js('BootBox', base_UI.'libs/BootBox/bootbox.js');
            /*Login Js file*/
            Assets::js('LoginJs',base_UI.'js/Auth/login.js');
            /*Register Js file*/
            Assets::js('RegisterJs',base_UI.'js/Auth/register.js');
            //uLogin js
            Assets::js('uLogin','http://ulogin.ru/js/ulogin.js');

            //Add notification plugin
            Assets::js('notification',base_UI.'libs/bootstrap/msg/bootstrap-msg.js');
            Assets::css('notification',base_UI.'libs/bootstrap/msg/bootstrap-msg.css');

            Assets::css('AdminLTE',base_UI.'AdminLTE/css/AdminLTE.css');
            Assets::js('AdminLTE_App',base_UI.'AdminLTE/js/AdminLTE/app.js');

            $this->template = \Smarty\View::init();

            if(!Request::current()->is_ajax())
            {
                $access = new \Auth\Access(\Registry::getCurrentUser()->access_level);

                $this->template->assign(['current_user'=>\Registry::getCurrentUser(),
                    'isAdmin'       => $access->get(\Auth\Access::User_Is_Admin),
                    'isModerator'   => $access->get(\Auth\Access::User_Is_Moderator)]);
            }

        }
    }

    /**
     *
     */
    public function after()
    {

        /*if(!Request::current()->is_ajax())
        {
            $access = new \Auth\Access(\Registry::getCurrentUser()->access_level);

            $this->template->assign(['current_user'=>\Registry::getCurrentUser(),
                'isAdmin'       => $access->get(\Auth\Access::User_Is_Admin),
                'isModerator'   => $access->get(\Auth\Access::User_Is_Moderator)]);
        }*/

    }

    public function setJSONHeader()
    {
        $this->response->headers('Content-Type', 'application/json');
        header('Content-type: application/json');
    }

    public function addBootstrapModal()
    {
        \Assets::js('Bootstrap_Modal', base_UI.'js/bootstrap-modal.js');
        \Assets::js('Bootstrap_Modal_Base', base_UI.'lib/bootstrap/bootstrap-modal.js');
    }

    public function addMultipleGalleryUploader()
    {
        \Assets::js('Templates', 'http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js');
        \Assets::js('Load-Image', 'http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js');
        \Assets::js('Canvas-to-Blob','http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js');
        \Assets::js('vendor-jquery-ui-widget', base_UI.'libs/uploader/js/vendor/jquery.ui.widget.js');
        \Assets::js('fileupload', base_UI.'libs/uploader/js/jquery.fileupload.js');
        \Assets::js('iframe-transport', base_UI.'libs/uploader/js/jquery.iframe-transport.js');
        \Assets::js('fileupload-process', base_UI.'libs/uploader/js/jquery.fileupload-process.js');
        \Assets::js('fileupload-image', base_UI.'libs/uploader/js/jquery.fileupload-image.js');
        \Assets::js('fileupload-validate', base_UI.'libs/uploader/js/jquery.fileupload-validate.js');
        \Assets::js('fileupload-ui', base_UI.'libs/uploader/js/jquery.fileupload-ui.js');
        \Assets::css('fileupload', base_UI.'libs/uploader/css/style.css');
        \Assets::css('fileuploads', base_UI.'libs/uploader/css/jquery.fileupload.css');
    }

    public function addCKEditor()
    {
        \Assets::js('ckeditor', base_UI.'libs/ckeditor/ckeditor.js');
        \Assets::js('ckeditor_config', base_UI.'libs/ckeditor/config.js');
        \Assets::css('ckeditor', base_UI.'libs/ckeditor/contents.css');
    }

    public function addSelect2()
    {
        \Assets::js('select2', base_UI.'libs/select2/select2.js');
        \Assets::css('select2', base_UI.'libs/select2/select2.css');
        \Assets::css('select2-bootstrap', base_UI.'libs/select2/select2-bootstrap.css');
    }

}