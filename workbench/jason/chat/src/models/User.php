<?php
namespace Jason\Chat\Models;

use Eloquent, Validator;

class User extends  Eloquent{

    protected $table = 'chat_users';

    protected $primaryKey = 'user_id';

    protected $rules = array(
        'name'=>'required|min:2',
        'gender'=>'required',
    );

    protected $errors;

    public function validate()
    {
        $v = Validator::make($this->attributes, $this->rules);

        if ($v->passes())
        {
            return true;
        }

        $this->setErrors($v->messages());

        return false;
    }

    protected function setErrors($errors)
    {
        $this->errors = $errors;
        return false;
    }

    /**
     * Retrieve error message bag
     */
    public function getErrors()
    {
        return $this->errors;
    }

}