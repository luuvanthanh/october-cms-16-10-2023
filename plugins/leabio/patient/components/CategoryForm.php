<?php namespace Leabio\Patient\Components;

use Cms\Classes\ComponentBase;
use Input;
use Redirect;
use Flash;
use Leabio\Patient\Models\Category;

/**
 * CategoryForm Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class CategoryForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'category Form',
            'description' => 'Display form category'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }

    public function onSave()
    {
        $name = Input::get('name');
        $category = new Category();
        $category->name = $name;
        
        $category->save();

        Flash::success('Add category success');

        return Redirect::back();
    }
}
