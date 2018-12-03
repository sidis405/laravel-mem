<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\CategoryRequest as UpdateRequest;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/categories');
        $this->crud->setEntityNameStrings('category', 'categories');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->removeFields(['slug', 'lft', 'rgt', 'depth', 'parent_id']);
        $this->crud->removeColumns(['slug', 'lft', 'rgt', 'depth']);

        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Parent", // Table column heading
           'type' => "select",
           'name' => 'parent_id', // the column that contains the ID of that connected entity;
           'entity' => 'parent', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Category", // foreign key model
        ]);

        $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        $this->crud->enableReorder('name', 2);

        // add asterisk for fields that are required in CategoryRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
