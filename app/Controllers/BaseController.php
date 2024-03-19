<?php

namespace App\Controllers;

use App\Models\ChatMessageModel;
use App\Models\ChatModel;
use App\Models\EventModel;
use App\Models\EventyGroupModel;
use App\Models\EventyUserModel;
use App\Models\GroupModel;
use App\Models\SiteSettingsModel;
use App\Models\UserGroupModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use IonAuth\Libraries\IonAuth;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{

    public $ionAuth;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];
    protected SiteSettingsModel $model;

    /**
     * Promene modelu
    */
    
    protected $siteSettings;
    protected $userModel;
    protected $chatModel;
    protected $chatMessageModel;
    protected $eventModel;
    protected $eventUserModel;
    protected $groupModel;
    protected $userGroupModel;
    protected $eventGroupModel;
    

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->model = new SiteSettingsModel();

        // Preload any models, libraries, etc, here.
        $this->ionAuth = new IonAuth();
        $this->siteSettings = $this->model->getSettings();
        
        $this->eventModel = new EventModel();
        $this->userModel = new UserModel();
        $this->userModel = new UserModel();
        $this->chatModel = new ChatModel();
        $this->chatMessageModel = new ChatMessageModel();
        $this->eventModel = new EventModel();
        $this->eventGroupModel = new EventyGroupModel();
        $this->eventUserModel = new EventyUserModel();
        $this->groupModel = new GroupModel();
        $this->userGroupModel = new UserGroupModel();
        $this->eventGroupModel = new EventyGroupModel();

        // E.g.: $this->session = \Config\Services::session();
    }
}
