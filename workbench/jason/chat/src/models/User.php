<?php
namespace Jason\Chat\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends \Illuminate\Database\Eloquent\Model{

    protected $table = 'chat_users';

    protected $primaryKey = 'user_id';

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = array( 'name', 'gender', 'email', 'channelId');

    protected $rules = array(
        'name'=>'required|min:2',
        'gender'=>'required',
    );

    protected $errors;

    public function validate()
    {
        $v = \Illuminate\Support\Facades\Validator::make($this->attributes, $this->rules);

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