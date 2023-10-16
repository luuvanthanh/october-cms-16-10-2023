<?php

namespace Leabio\Patient\Components;

use Cms\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use Redirect;

/**
 * ContactForm Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class ContactForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Contact Form',
            'description' => 'Form contact'
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }

    public function onSend()
    {
        $data = [
            'name' => Input::get('name'),
            'email' => Input::get('email')
        ];
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        if ($validator->fails()) {
            
            return Redirect::back()->withErrors($validator);
        } else {
            $vars = ['name' => Input::get('name'), 'email' => Input::get('email'), 'content' => Input::get('content')];
            Mail::send('leabio.patient::mail.message', $vars, function ($message) {
                $message->to('luuvanthanh121@gmail.com', 'Admin Person');
                $message->subject('New message from contact form');
            });
        }
    }
}
