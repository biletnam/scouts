<?php
/**
 * Created by PhpStorm.
 * User: timva
 * Date: 4/02/2018
 * Time: 11:09
 */

namespace App\Providers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CspServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::share('scriptNonce', config('secure-headers.csp.script-src.nonces.primary'));
	}
}