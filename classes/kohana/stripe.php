<?php defined('SYSPATH') or die('No direct script access.');
/**
* Stripe
*
* @package        Stripe
* @author         Jean-Nicolas Boulay
* @copyright      (c) 2012 Jean-Nicolas Boulay
* @license        http://www.opensource.org/licenses/isc-license.txt
*/

class Kohana_Stripe {

	/** @var string|null $status */
	public static $status = NULL;
	/** @var string|null $secret_key */
	private static $secret_key = NULL;
	/** @var string|null $publishable_key */
	public static $publishable_key = NULL;

	/**
	 * @return void
+   */
	public static function init()
	{
		if (self::$secret_key != null && self::$publishable_key != null) {
			return;
		}

		require_once Kohana::find_file('vendor', 'stripe-php/init' , 'php');

		$config = Kohana::config('stripe');
		if (is_scalar($config['status']))
			self::$status = (string) $config['status'];
		if (is_array($config[self::$status])) {
			self::$secret_key = (string) $config[self::$status]['secret_key'];
			self::$publishable_key = (string) $config[self::$status]['publishable_key'];
			Stripe\Stripe::setApiKey(self::$secret_key);
		}
	}

} // End of Stripe
