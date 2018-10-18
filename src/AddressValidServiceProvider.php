<?php namespace Sonlabs\AddressValid;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class AddressValidServiceProvider extends ServiceProvider {


	//protected $defer = false;

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        Validator::extend('check_address', function ($attribute, $value) {
            if(!empty($value)){
                $remove_special_char = preg_replace("/[^ \w]+/", "", $value);
                $remove_spaces = str_replace(' ', '+', $remove_special_char);
                
                $client = new Client(['verify' => false]);
                $result = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json', [
                    'query' => ['address' => $remove_spaces],
		    'key' => env('GOOGLE_MAPS_API_KEY')
                ]);
                $response = json_decode($result->getBody());    
                if ($response->status=='OK') {
                    return TRUE;
                }
                return FALSE;
            }
            return FALSE;
        });
	}
	public function register()
    {
	}
}
