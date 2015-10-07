<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
    public function __construct(){

    	//construct example with session and twig, see below comments in index if you don't want it
        parent::__construct();
        $this->_ci = & get_instance();

	 	// init paths
	    $this->template_dir = '../codeigniter/application/views';
	    $this->cache_dir = '../codeigniter/application/cache';

	    // load environment
	    $loader = new Twig_Loader_Filesystem($this->template_dir, $this->cache_dir);
	    $this->_twig_env = new Twig_Environment($loader, array(
	                                            'cache' => $this->cache_dir,
	                                            'auto_reload' => TRUE));
		$this->_ci->load->library('session');


	    // ADD SESSION TO TWIG - JZ
	    $this->_twig_env->addGlobal('session', $this->_ci->session);
	    // SESSION IS NOW AVAILABLE IN TWIG TEMPLATES!

		// $this->ci_function_init();

		if(!isset($_SESSION)){
		    session_start();
		}
		if (!isset($_SESSION['count'])) {
		  $_SESSION['count'] = 0;
		} else {
		  $_SESSION['count']++;
		}

    }
	
	public function index(){

		// If you haven't composer:
		//require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';
		//Twig_Autoloader::register();


		//previous configuration, before I made construct with session too
		//$loader = new Twig_Loader_Filesystem('../codeigniter/application/views');
		//$twig = new Twig_Environment($loader);

		// To get twig cache
		//$twig = new Twig_Environment($loader, array(
		//    'cache' => 'application/cache/twig',
		//));
		$data = array();
		$data['foo'] = 'This is cool!';
		$data['bar'] = 'Twig + CodeIgniter rocks!';
		$this->_twig_env->display('welcome_message.php',$data);
		//echo $twig->render('welcome_message.php', array('name' => 'Fabien'));
		//$template = $twig->loadTemplate('welcome_message.php');
		//echo $template->render(array('the' => 'variables', 'go' => 'here'));

	}
}
