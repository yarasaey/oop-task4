<?php
class Validation{
    private  $errors=[];


    public function validate(array $data , array $rules){
        foreach ($rules as $field => $rulesArray) {
            
            if (!is_array($rulesArray)) {
                throw new InvalidArgumentException("Validation rules for '$field' must be an array.");
            }

            foreach ($rulesArray as $rule) {
                $this->applyRule($field, $rule, $data[$field] ?? null);
            }
        }

    }
    private function applyRule($field, $rule, $value) {
        $params = explode(':', $rule);
        $ruleName = $params[0];

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    $this->errors[$field][] = "$field is required.";
                }
                break;

            case 'string':
                if (!is_string($value)) {
                    $this->errors[$field][] = "$field must be a string.";
                }
                break;

            case 'numeric':
                if (!is_numeric($value)) {
                    $this->errors[$field][] = "$field must be a number.";
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field][] = "$field must be a valid email address.";
                }
                break;

            case 'min':
                if (isset($params[1]) && strlen($value) < (int)$params[1]) {
                    $this->errors[$field][] = "$field must be at least {$params[1]} characters long.";
                }
                break;

           
        }
    }

    public function getErrors() {
        return $this->errors;
    }

}