<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
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
abstract class BaseController extends Controller
{
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
    protected $helpers = ['array','form','url'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();
        $this->tb_dokumenmodel1 = new \App\Models\Tb_dokumenmodel();
        $this->tb_usermodel1 = new \App\Models\Tb_usermodel();
        $this->tb_dokizinmodel1 = new \App\Models\Tb_dokizinmodel();
        $this->tb_apdmodel1 = new \App\Models\Tb_apdmodel();
        $this->tb_promodel1 = new \App\Models\Tb_promodeL();
        $this->tb_kegiatanmodel1 = new \App\Models\Tb_kegiatanmodeL();
        $this->tb_rekamanmodel1 = new \App\Models\Tb_rekamanmodeL();
        $this->tb_patrolmodel1 = new \App\Models\Tb_patrolmodeL();
        $this->Tb_insidenmodel1 = new \App\Models\Tb_insidenmodeL();    
    }
}
