<?php

namespace Leabio\Patient\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Leabio\Patient\Models\Category;

/**
 * MyWidget Form Widget
 *
 * @link https://docs.octobercms.com/3.x/extend/forms/form-widgets.html
 */
class MyWidget extends FormWidgetBase
{
    protected $defaultAlias = 'patient_my_widget';
    protected $value;

    public function init()
    {
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('mywidget');
    }

    public function prepareVars()
    {
        $this->vars['id'] = $this->model->id;
        $this->vars['categories'] = Category::all()->lists('name', 'id');
        $this->vars['selectedValues'] = $this->getLoadValue();
        $this->vars['name'] = $this->getFieldName();
        $this->vars['value'] = $this->getLoadValue();
      
    }

    public function loadAssets()
    {
        $this->addCss('css/mywidget.css');
        $this->addJs('js/mywidget.js');
    }

    public function getSaveValue($value)
    {
        // $this->model->category_id = 2;
        // $this->model->save();

        return $value;
    }

    public function widgetDetails()
    {
        return [
            'name' => 'My WidGet',
            'description' => 'Field for adding'
        ];
    }
}
