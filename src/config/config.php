<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Template Type
    |--------------------------------------------------------------------------
    |
    | Most JavaScript libraries/frameworks require the templates'
    | script tags to have a special type value to indicate that
    | they are actually templates. You can set here the value
    | for the type attribute. It's set to "text/ng-template"
    | which is what the popular Angular JS framework uses.
    |
    */
    'type' => 'text/ng-template',

    /*
    |--------------------------------------------------------------------------
    | Strip Extension
    |--------------------------------------------------------------------------
    |
    | The relative path to each template will be used as the value for
    | its "id" attribute. This option controls whether to strip off
    | the extension from the end of the path. If set to "true", a
    | template file at "templates/orders/index.html" would have
    | its id attribute set to "orders/index". Otherwise, the
    | "id" attribute's value will be "orders/index.html".
    |
    */
    'strip' => true,

    /*
    |--------------------------------------------------------------------------
    | Exclude Pattern
    |--------------------------------------------------------------------------
    |
    | You may want to exclude some files or directores from being
    | rendered as templates. You can set this property to either
    | a string or a regex, depending on your needs. For example,
    | to exclude any files/directories that have an underscore
    | in them, set this to "_", and they will all be ignored.
    |
    */
    'exclude' => null,

    /*
    |--------------------------------------------------------------------------
    | Views Directory
    |--------------------------------------------------------------------------
    |
    | This option controls the base directory where all the views
    | are stored. When rendering the templates, you will specify
    | the subdirectory within this directory where your actual
    | templates are stored. If set to "null" the package will
    | intelligently use your app's default views directory.
    |
    */
    'views' => null,

];
