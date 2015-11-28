<?php

return [
    'formstart' => '<form class="" {{attrs}}>',
    'label' => '<label class=" control-label" {{attrs}}>{{text}}</label>',
    'input' => '<div class=""><input  class="form-control" type="{{type}}" name="{{name}}" {{attrs}} /></div>',
    'select' => '<div class=""><select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select></div>',
    'inputContainer' => '<div class="form-group {{required}}" form-type="{{type}}">{{content}}</div>',
    'checkContainer' => '',
    'inputSubmit' => '<button type="submit" class="btn btn-default" {{attrs}}>{{text}}</button>',
    'button' => ' <button type="submit" class="btn btn-primary" {{attrs}}>{{text}}</button>',
    'error' => '<span class="help-block">{{content}}</span>',
    'inputContainerError' => '<div class="has-error">{{content}}<div>{{error}}</div></div>',
];
