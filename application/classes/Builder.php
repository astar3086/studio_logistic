<?php

use Model\User;
use Model\UserSession;

class Builder extends \Controller
{
    /**
     * @var \Smarty
     */
    protected $template;
    protected $rediska;
    protected $chat_session;
    protected $data;

    protected $client_id      = "5189019";
    protected $client_secret  = "dezA3WLuOadltFGr3vhp";
    protected $redirect_uri   = "Index/getAccess";
    public $i18n = 'ua';

    public $localis = [
        'ua' => 'УКР',
        'en' => 'ENG',
    ];

    protected $config = array(
        // Возможные значения: small, panel, window
        'type'             => 'panel',

        // Сервисы, выводимые сразу
        'providers'        => array(
            'vkontakte',
            'facebook',
            /*'twitter',
            'google',*/
        ),

        // Выводимые при наведении
        'hidden'         => array(
            /*'odnoklassniki',
            'mailru',
            'livejournal',*/
            'openid',
            'flickr',
            'instagram',
        ),

        // Эти поля используются для значения поля username в таблице users
        'username'         => array (
            'first_name',
            'last_name',
        ),

        // Обязательные поля
        'fields'         => array(
            'email',
        ),

        // Необязательные поля
        'optional'        => array(),
    );

    /**
     *
     */
    public function before()
    {

        $is_guest = \Registry::getCurrentUser()
            ->isGuest();

        // Дополнительные функции
        $this->InitEnvironment();

        if(!Request::current()->is_ajax())
        {
            // Add Google Font
            Assets::css('Google_Font','https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic&subset=latin,cyrillic-ext,cyrillic');

            /*ADD google maps JS*/
            Assets::js('google_maps_api','https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=drawing&places&geometry');
            Assets::js('jQuery','https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');

            Assets::css('bootstrap', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css', ['media' => 'screen']);
            Assets::js('bootstrap', 'http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js');

            //GMAP Plugin js
            Assets::js('cluster',base_UI.'js/plugins/gmap/marker.js');
            Assets::js('gmap',base_UI.'js/plugins/gmap/gmaps.js');
            /*Базовые стили шаблона*/

            //Global Assets
            Assets::js('globalJS',base_UI.'js/pages/global.js');
            Assets::css('awesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
            Assets::css('stl',base_UI.'css/style.css');

            /*BootBox Js file*/
            Assets::js('BootBox', base_UI.'libs/BootBox/bootbox.js');
            /*Login Js file*/
            Assets::js('LoginJs',base_UI.'js/Auth/login.js');
            /*Register Js file*/
            Assets::js('RegisterJs',base_UI.'js/Auth/register.js');
            //Zopim Helper js
            Assets::js('zopim',base_UI.'js/index/zopim.js');

            //MAP js
            Assets::js('map1',base_UI.'js/map/map.js');
            Assets::js('map2',base_UI.'js/pages/map.js');
            Assets::js('map3',base_UI.'js/map/catalog.js');


            $this->template = \smarty\View::init();

            $this->renderULogin();

            if( !$is_guest )
            {
                $access = new \Auth\Access(\Registry::getCurrentUser()->access_level);
                $user_id = \Registry::getCurrentUser()->iduser;

                $this->template->assign(['current_user'=>\Registry::getCurrentUser(),
                    'isAdmin'       => $access->get(\Auth\Access::User_Is_Admin),
                    'isModerator'   => $access->get(\Auth\Access::User_Is_Moderator)
                ]);

            }
            else
            {
                $this->template->assign(['current_user'=>\Registry::getCurrentUser()]);
            }

            $this->template->assign([
                'localis' => $this->localis,
                'local'   => $this->i18n,
            ]);
        } else {
            $this->setJSONHeader();

            // Mobile API
            if ( !isset($_POST) )
            {
                $error = array('status' => 'error', 'message' => 'No Data','code' =>'2');
                echo json_encode($error);
                return;
            }

            /** @var $dbSession UserSession */
            if ( $_POST['token'] ){
                $condition = (new \DBCriteria())
                    ->addColumnCondition(
                        [
                            'token' => $_POST['token']
                        ])
                    ->addCondition('`expired`>=UNIX_TIMESTAMP(NOW())');

                /** @var $dbSession UserSession */
                $sessionData = UserSession::model()->with('user')->find($condition);
                \Registry::setCurrentUser($sessionData->user);
            }

        }


    }

    public function InitEnvironment()
    {
        // Localization
        $this->i18nInit();

    }

    public function i18nInit()
    {
        $session = Session::instance();
        if( $this->i18n = $this->request->post('i18n') )
        {
            $session->set('i18n', $this->i18n);
            $error = array('status' => 'success');

            echo json_encode($error);
            exit;

        }  else if ( $session->get('i18n') ){
            $this->i18n = $session->get('i18n');
        } else {
            $this->i18n = 'ua';
        }

        // Set Lang
        \I18n::lang( $this->i18n );
    }

    public function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
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

    public function addBootstrapMultiSelect()
    {
        \Assets::js('Bootstrap_Multy', base_UI.'libs/bootstrap/bootstrap-multiselect.js');
        \Assets::css('Bootstrap_Multy', base_UI.'css/bootstrap/bootstrap-multiselect.css');
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

    public function emailSend( $to, $subject, $message )
    {
        $config_email = Kohana::$config->load('email');
        Email::connect( $config_email );

        $from = $config_email->get('admin_email');
        $send = Email::send( $to, $from, $subject, $message, $html = true );
        return $send;
    }

    public function renderULogin()
    {
        $params =
            'display=' . $this->config['type'] .
            '&fields=' . implode(',', array_merge($this->config['username'], $this->config['fields'])) .
            '&providers=' . implode(',', $this->config['providers']) .
            '&hidden=' . implode(',', $this->config['hidden']) .
            '&redirect_uri=' . Kohana::$base_url . 'Index/uloginAuth' .
            '&optional=' . implode(',', $this->config['optional']);

        $uniq_id = "uLogin_" . rand();
        $this->template->assign(['uniq_id' => $uniq_id,
            'params' => $params
        ]);
    }

}