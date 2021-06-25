<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Censore implements Rule
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
        //

        // Banned words
        $words = array('ass','boob','choda','chudi', 'fuck', 'shit', );
        foreach ($words as $word) {
            if (stripos($value, $word) !== false) {
                return false;
            }

        }
        return true;

        // return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return 'The validation error message.';

        return 'The :attribute must not have censored words.';
    }
}
