<?php namespace Leabio\Patient\Components;

use Cms\Classes\ComponentBase;
use Leabio\Patient\Models\Category;

/**
 * CategoryList Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class CategoryList extends ComponentBase
{
    public $categories;
    public function componentDetails()
    {
        return [
            'name' => 'Category List',
            'description' => 'Hiển thị danh sách category'
        ];
    }

    public function onRun()
    {
        $this->categories = Category::all();
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }
}
