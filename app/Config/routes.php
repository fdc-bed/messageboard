<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'Main', 'action' => 'index'));
	Router::connect('/messages', array('controller' => 'Messages', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	// Router::connect('/pages/*', array('controller' => 'Pages', 'action' => 'display'));
	Router::connect('/login', array('controller' => 'Users', 'action' => 'login'));
	Router::connect('/register', array('controller' => 'Users', 'action' => 'register'));
	Router::connect('/logout', array('controller'=> 'Users', 'action' => 'logout'));
	Router::connect('/profile', array('controller'=> 'Users', 'action' => 'profile'));
	Router::connect('/update-profile', array('controller'=> 'Users', 'action' => 'updateProfile'));
	Router::connect('/acccount-settings', array('controller'=> 'Users', 'action' => 'accountSettings'));

	Router::connect('/thank-you-page', array('controller'=> 'Main', 'action' => 'thankYouPage'));

	// MESSAGES
	Router::connect('/create-new-message', array('controller'=> 'Messages', 'action' => 'createMessage'));

	// MY API END POINT
	Router::connect('/users/search/:data_string', array('controller'=> 'Users', 'action' => 'getSearchUsers'));
	Router::connect('/users/search/', array('controller'=> 'Users', 'action' => 'getSearchUsers'));
	Router::connect('/user/id/:data_id', array('controller'=> 'Users', 'action' => 'getUserData'));

	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
