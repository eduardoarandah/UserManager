<?php

namespace Backpack\UserManager\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest;
use Backpack\UserManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use Backpack\UserManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class UserCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(config('backpack.usermanager.user_model'));
        $this->crud->setEntityNameStrings(trans('backpack::usermanager.user'), trans('backpack::usermanager.users'));
        $this->crud->setRoute(config('backpack.base.route_prefix').'/user');
        $this->crud->enableAjaxTable();

        // Columns.
        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::usermanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::usermanager.email'),
                'type'  => 'email',
            ]            
        ]);

        // Fields
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('backpack::usermanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::usermanager.email'),
                'type'  => 'email',
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::usermanager.password'),
                'type'  => 'password',
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::usermanager.password_confirmation'),
                'type'  => 'password',
            ]
        ]);
    }

    /**
     * Store a newly created resource in the database.
     *
     * @param StoreRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $this->handlePasswordInput($request);

        return parent::storeCrud($request);
    }

    /**
     * Update the specified resource in the database.
     *
     * @param UpdateRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $this->handlePasswordInput($request);

        return parent::updateCrud($request);
    }

    /**
     * Handle password input fields.
     *
     * @param CrudRequest $request
     */
    protected function handlePasswordInput(CrudRequest $request)
    {
        // Remove fields not present on the user.
        $request->request->remove('password_confirmation');

        // Encrypt password if specified.
        if ($request->input('password')) {
            $request->request->set('password', bcrypt($request->input('password')));
        } else {
            $request->request->remove('password');
        }
    }
}
