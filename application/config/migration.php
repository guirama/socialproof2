<?php

	/**
	 *
	 * This is the CI config migration file
	 *
	 * @package    bizydads_hof\config\migration
	 * @version    1.0
	 * @copyright  2015, BizyCorp Internal Systems Development
	 * @license    private, All rights reserved
	 * @author     CI
	 * @uses
	 * @see
	 * @created
	 * @modified
	 * @modification
	 *
	 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Enable/Disable Migrations
|--------------------------------------------------------------------------
|
| Migrations are disabled by default but should be enabled 
| whenever you intend to do a schema migration.
|
*/
$config['migration_enabled'] = FALSE;


/*
|--------------------------------------------------------------------------
| Migrations version
|--------------------------------------------------------------------------
|
| This is used to set migration version that the file system should be on.
| If you run $this->migration->latest() this is the version that schema will
| be upgraded / downgraded to.
|
*/
$config['migration_version'] = 0;


/*
|--------------------------------------------------------------------------
| Migrations Path
|--------------------------------------------------------------------------
|
| Path to your migrations folder.
| Typically, it will be within your application path.
| Also, writing permission is required within the migrations path.
|
*/
$config['migration_path'] = APPPATH . 'migrations/';


/* End of file migration.php */
/* Location: ./application/config/migration.php */