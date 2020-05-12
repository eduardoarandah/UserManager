<?php

namespace EduardoArandaH\UserManager\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest;
use EduardoArandaH\UserManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use EduardoArandaH\UserManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(config('eduardoarandah.usermanager.user_model'));
        $this->crud->setEntityNameStrings(trans('eduardoarandah::usermanager.user'), trans('eduardoarandah::usermanager.users'));
        $this->crud->setRoute(config('backpack.base.route_prefix').'/user');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('eduardoarandah::usermanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('eduardoarandah::usermanager.email'),
                'type'  => 'email',
            ]
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(StoreRequest::class);
        $this->addFields();
    }

    protected function setupUpdateOperation()
    {
        $this->crud->setValidation(UpdateRequest::class);
        $this->addFields();
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

        return $this->traitStore($request);
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

        return $this->traitUpdate($request);
    }

    /**
     * Add the fields needed in the Create and Update operations.
     */
    protected function addFields()
    {
        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('eduardoarandah::usermanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => trans('eduardoarandah::usermanager.email'),
                'type'  => 'email',
            ],
            [
                'name'  => 'password',
                'label' => trans('eduardoarandah::usermanager.password'),
                'type'  => 'password',
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('eduardoarandah::usermanager.password_confirmation'),
                'type'  => 'password',
            ]
        ]);
    }

    /**
     * Handle password input fields.
     *
     * @param CrudRequest $request
     */
    protected function handlePasswordInput(CrudRequest $request)
    {
        $crud_request = $this->crud->getRequest();

        // If a password was specified
        if ($request->input('password')) {
            // encrypt it before storing it
            $hashed_password = bcrypt($request->input('password'));

            $crud_request->request->set('password', $hashed_password);
            $crud_request->request->set('password_confirmation', $hashed_password);
        } else {
            // ignore the password inputs entirely
            $crud_request->request->remove('password');
            $crud_request->request->remove('password_confirmation');
        }

        $this->crud->setRequest($crud_request);
    }
}
