<?php

namespace EduardoArandaH\UserManager\app\Http\Requests;

use Backpack\CRUD\app\Http\Requests\CrudRequest;

class UserStoreCrudRequest extends CrudRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'required|unique:'.config('eduardoarandah.usermanager.table_name','users').',email',
            'name'     => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
