<?php

namespace App\Core;

class Validator
{
    public static function validate($data, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            $value = trim($data[$field] ?? '');

            if (strpos($rule, 'required') !== false && empty($value)) {
                $errors[$field] = "$field is required.";
            }

            if (strpos($rule, 'email') !== false && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = "$field must be a valid email.";
            }

            if (preg_match('/min:(\d+)/', $rule, $match) && strlen($value) < $match[1]) {
                $errors[$field] = "$field must be at least {$match[1]} characters.";
            }

            if (preg_match('/max:(\d+)/', $rule, $match) && strlen($value) > $match[1]) {
                $errors[$field] = "$field cannot be more than {$match[1]} characters.";
            }

            




        }

        return $errors;
    }
}
