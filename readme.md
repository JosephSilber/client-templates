## Client Templates

This package provides a simple mechanism for you to load up all your client template views into your main application view.

## What? Why?

Single page applications (SPAs) usually work by having the templates rendered on the client. For bigger applications, those templates might be loaded asynchronously as you need them. For smaller applications, it may make more sense to load all of your templates with the initial page load.

Since [HTML templates](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/template) are pretty new and [not yet widely supported](http://caniuse.com/#search=templates), most frameworks rely on the templates being served within `script` tags, marked up with some special `type` attribute to indicate that it is in fact a template.

Using this package, you can keep your templates nicely organized, with each template in its own separate file. With one simple call, you can then inject all of your templates into your main application view.

## Documentation

This is a framework-agnostic package. It also comes with special Laravel integration classes, but those are optional.

Begin by installing this package through Composer. Open your terminal to your project's root directory, and enter this at the prompt:

    composer require "silber/client-templates:dev-master"

### Laravel Integration

Once the composer installation completes, you can add the service provider and the alias. Open `app/config/app.php`, and make the following changes:

1) Add a new item to the `providers` array:

```
'Silber\Templates\TemplatesServiceProvider'
```

2) Add a new item to the `aliases` array:

```
'Templates' => 'Silber\Templates\TemplatesFacade'
```

That's it! You're all set to go.

### Usage

Now that you're all set up, you can start by actually creating your templates. Within the `views` directory, create a new `templates` directory. This is where you will keep all of your templates.

Here's a sample directory structure:

![A sample template directory structure](http://i.imgur.com/HYxsTzK.png)

Whithin each of those files, you will have only the HTML for that particular template.

Then, within your main `index.blade.php` file - right before the closing `<body>` tag - add this tiny piece of code:

```
{{ Templates::render('templates') }}
```

This will automatically render all of your templates, as follows:

```html
<script type="text/ng-template" id="orders/index">
	<!-- ...the contents of the template... -->
</script>
<script type="text/ng-template" id="orders/show">
	<!-- ...the contents of the template... -->
</script>
<script type="text/ng-template" id="products/index">
	<!-- ...the contents of the template... -->
</script>
<script type="text/ng-template" id="products/show">
	<!-- ...the contents of the template... -->
</script>
```

You can now use these templates in your favorite JS framework!

## Configuration

If you wish to change any of the package's default options, you will first need to publish the configuration file to your app's `config` directory. You can do this by running the following artisan command:

```
php artisan config:publish silber/client-templates
```

This will create a new config file at `app/config/packages/silber/client-templates/config.php`. You can now edit this file to change the default options.

### Template Type

By default, the `type` attribute is set to `text/ng-template`, which is what AngularJS uses. This can be changed in the package's configuration file. For example:

```php
'type' => 'text/x-handlebars-template'
```

### Strip Extension

By default, the template file's extension will be stripped from the HTML `id` attribute. If you wish to leave it in there, set it to `false`:

```php
'strip' => false
```

This will then output templates with their file's extension intact. For example:

```html
<script type="text/ng-template" id="orders/index.html"></script>
```

### Exclude Pattern

Sometimes you may wish to exclude some files or directories from being rendered as their own templates:

```php
'exclude' => '_includes'
```

### Views Directory

By default, the base directory for the templates is in the views directory. If you wish to change that, you can do so by setting it here:

```php
'views' => public_path('html')
```

## Contributing

Thank you for considering contributing! This project follows [Laravel's coding style](http://laravel.com/docs/4.2/contributions#coding-style).

### License

The `client-templates` package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
