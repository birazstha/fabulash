<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckClientSecret implements Rule
{

    protected $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }


    public function passes($attribute, $value)
    {
        $client = DB::table('oauth_clients')->where('id', $this->clientId)->first();
        if (isset($client) && $client->secret == $value) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The client secret is invalid.';
    }
}
