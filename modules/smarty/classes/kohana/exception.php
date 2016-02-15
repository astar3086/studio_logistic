<?php
/**
 * Created by Wir_Wolf.
 * Author: Andru Cherny
 * E-mail: wir_wolf@bk.ru
 * Date: 13.11.13
 * Time: 19:52
 */
//class Error_Exception extends Kohana_Error_Exception {}
class Smarty_Exception extends Kohana_Kohana_Exception
{
	public static function handlers(Exception $e)
	{
		die();
		if(stripos(get_class($e),'Smarty'))
		{
			echo 'Smarty Found';
		}
		if (Kohana::DEVELOPMENT === Kohana::$environment)
		{
			parent::handler($e);
		}
		else
		{
			try
			{
				Kohana::$log->add(Log::ERROR, parent::text($e));

				$attributes = array
				(
					'code'  => 500,
					'e' => rawurlencode($e->getMessage()),
				);

				if ($e instanceof HTTP_Exception)
				{
					$attributes['code'] = $e->getCode();
				}

				// Error sub-request.
				echo Request::factory(Route::get('error')->uri($attributes))
				            ->execute()
				            ->send_headers()
				            ->body();
			}
			catch (Exception $e)
			{
				// Clean the output buffer if one exists
				ob_get_level() and ob_clean();

				// Display the exception text
				echo parent::text($e);

				// Exit with an error status
				exit(1);
			}
		}
	}

	public static function handler(Exception $e)
	{
		$response = Kohana_Exception::_handler($e);
		var_dump($e);
		// Send the response to the browser
		//echo $response->send_headers()->body();

		//exit(1);
	}

	/**
	 * PHP error handler, converts all errors into ErrorExceptions. This handler
	 * respects error_reporting settings.
	 *
	 * @param      $code
	 * @param      $error
	 * @param null $file
	 * @param null $line
	 *
	 * @throws ErrorException
	 * @return  TRUE
	 */
	public static function error_handler($code, $error, $file = NULL, $line = NULL)
	{
		var_dump($code, $error, $file, $line);
		if (error_reporting() & $code)
		{
			// This error is not suppressed by current error reporting settings
			// Convert the error into an ErrorException
			//throw new ErrorException($error, $code, 0, $file, $line);
		}

		// Do not execute the PHP error handler
		return TRUE;
	}
}