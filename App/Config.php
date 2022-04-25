<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'mvclogin';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'karol';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'karol';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /**
     * Secret key for hashing
     * @var boolean
     */
    const SECRET_KEY = 'secret';
	
	const MAILGUN_DOMAIN='sandbox1ae1838f32814abf93f9ee9bf6477571.mailgun.org';
	
	const MAILGUN_API_KEY='9b684dc7361466f706bb8efae3e459fd-d2cc48bc-6b482ebc';
}
