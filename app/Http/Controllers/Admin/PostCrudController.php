<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PostRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Post');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/posts');
        $this->crud->setEntityNameStrings('post', 'posts');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->removeFields(['user_id', 'slug']);

        $this->crud->addField([ // image
            'label' => "Cover Image",
            'name' => "cover",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 3/2, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
        ]);

        $this->crud->addField([
            'name' => 'preview',
            'label' => 'Preview',
            'type' => 'summernote',
        ]);

        $this->crud->addField([
            'name' => 'body',
            'label' => 'Article Body',
            'type' => 'summernote',
        ]);

        $this->crud->addField([  // Select2
           'label' => "Category",
           'type' => 'select2',
           'name' => 'category_id', // the db column for the foreign key
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Category" // foreign key model
        ]);

        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
            'label' => "Article Tags",
            'type' => 'select2_multiple',
            'name' => 'tags', // the method that defines the relationship in your Model
            'entity' => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Tag", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'select_all' => true, // show Select All and Clear buttons?
        ]);

        $this->crud->removeColumns(['preview', 'body', 'slug']);

        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Category", // Table column heading
           'type' => "select",
           'name' => 'category_id', // the column that contains the ID of that connected entity;
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Category", // foreign key model
        ]);

        $this->crud->addColumn([
           // 1-n relationship
           'label' => "User", // Table column heading
           'type' => "select",
           'name' => 'user_id', // the column that contains the ID of that connected entity;
           'entity' => 'user', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\User", // foreign key model
        ]);

        $this->crud->addColumn([
           'name' => 'cover', // The db column name
           'label' => "Cover", // Table column heading
           'type' => 'image',
            // 'prefix' => 'folder/subfolder/',
            // optional width/height if 25px is not ok with you
            // 'height' => '30px',
            // 'width' => '30px',
        ]);

        $this->crud->addColumn([
           'name' => 'created_at', // The db column name
           'label' => "Date", // Table column heading
           'type' => 'date',
        ])->afterColumn('user_id');

        $this->crud->addFilter([ // select2 filter
          'name' => 'category_id',
          'type' => 'select2',
          'label'=> 'Category'
        ], function () {
            return \App\Category::all()->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'category_id', $value);
        });

        $this->crud->addFilter([ // select2_multiple filter
          'name' => 'tags',
          'type' => 'select2_multiple',
          'label'=> 'Tags'
        ], function () { // the options that show up in the select2
            return \App\Tag::all()->pluck('name', 'id')->toArray();
        }, function ($values) { // if the filter is active
            foreach (json_decode($values) as $key => $value) {
                $this->crud->query = $this->crud->query->whereHas('tags', function ($query) use ($value) {
                    $query->where('tag_id', $value);
                });
            }
        });

        $this->crud->addFilter(
            [ // daterange filter
           'type' => 'date_range',
           'name' => 'from_to',
           'label'=> 'Date range'
         ],
         false,
         function ($value) { // if the filter is active, apply these constraints
             $dates = json_decode($value);
             $this->crud->addClause('where', 'created_at', '>=', $dates->from);
             $this->crud->addClause('where', 'created_at', '<=', $dates->to);
         }
        );

        // add asterisk for fields that are required in PostRequest
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
