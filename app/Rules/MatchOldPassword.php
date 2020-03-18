<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use DB;

class MatchOldPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $a=Auth::user()->id;
        $password = DB::table('users')->where('id','=',$a)->value('password');

        return Hash::check($value, $password);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    
    public function message()
    {
        return 'You have entered an invalid existing password !';
    }
}
