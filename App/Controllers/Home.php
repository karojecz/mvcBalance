<?php

namespace App\Controllers;

use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
		//\App\Mail::send('karol.jeczmionka@o2.pl','test','tis is','<h1>gggg<h1>');
        View::renderTemplate('Home/index.html');
		
    }

}
