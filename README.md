# Address Validation in Laravel

```php
This package used for physical address verification  with google.

    1) composer require sonlabs/address-varification
    2) Add below line in your provider at (config\app.php) 
        'providers' => [
            ---------
            Sonlabs\AddressValid\AddressValidServiceProvider::class,
            ---------
        ],
    3) please add below line at (resources\lang\en\validation.php)
        'validation.check_address' => 'The :attribute must be validate.',
    
    You done, now please use with below sysntax
        In validation rules use login "check_address"

        $rules = [
            'name'     => 'required',
            'address' => 'required|check_address',
        ];
