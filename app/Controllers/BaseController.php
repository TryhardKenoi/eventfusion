<?php

namespace App\Controllers;

use App\Models\EventModel;
use App\Models\SiteSettingsModel;
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

    protected $siteSettings;
    protected $eventModel;
    protected $userModel;


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

        // E.g.: $this->session = \Config\Services::session();
    }
}
