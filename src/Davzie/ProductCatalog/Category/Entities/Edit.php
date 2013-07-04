<?php
namespace Davzie\ProductCatalog\Category\Entities;
use Davzie\ProductCatalog\Entity;
use App;
use Str;
use Input;

class Edit extends Entity {

    protected static $model = 'Davzie\ProductCatalog\Category';

    protected static $rules = [
        'id'            =>  'required|integer|exists:categories,id',
        'name'          =>  'required|max:255',
        'enabled'       =>  'integer'
    ];

    public function __construct( $currentId ){
        $this->setCurrentId( $currentId );

        // Dynamic Rules
        static::$rules['parent_id'] = 'integer|exists:categories,id|not_in:'.$currentId;
        static::$rules['url'] = 'required|alpha_dash|unique:categories,url,'.$currentId;

        // If we have a 0 through on parent ID then we can assume the user has not chosen anything
        if( Input::get('parent_id') == 0 ){
            unset( static::$rules['parent_id'] );
            static::$defaultData['parent_id'] = null;
        }

        // Default Data
        static::$defaultData['slug'] = Str::slug( Input::get('name') , '-' );
        static::$defaultData['description'] = Input::get('description');

        parent::__construct();
    }

}