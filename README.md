# Backpack\UserManager

An admin interface to easily add/edit/remove users, using [Laravel Backpack](https://laravelbackpack.com)

![user-manager](https://user-images.githubusercontent.com/4065733/40717133-e8b5701e-63d0-11e8-9f1d-540500161f64.png)

> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.


## Install

1) In your terminal:

``` bash
$ composer require backpack/usermanager
```

2) For Laravel <5.5, add the service provider to your config/app.php file:
```php
Backpack\UserManager\UserManagerServiceProvider::class,
```

3) Use the following traits on your User model:
```php
<?php namespace App;

use Backpack\CRUD\CrudTrait; // <------------------------------- this one
use Illuminate\Foundation\Auth\User as Authenticatable; 

class User extends Authenticatable
{
    use CrudTrait; // <----- this    

    /**
     * Your User Model content
     */
```

4) [Optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar_content.blade.php or menu.blade.php:

```html
<li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
```

## How to add/remove fields

Copy source code into your project

- Go to vendor/backpack/usermanager/src
- Copy routes in src/routes/backpack/usermanager.php into your routes/web.php file
- Copy src/app/Http/Controllers/UserCrudController.php in your app/Http/Controllers folder
- In UserCrudController set the model, example:

	$this->crud->setModel('App\Models\User'));

To add fields in when updating/creating:

[https://laravel-backpack.readme.io/docs/crud-fields](https://laravel-backpack.readme.io/docs/crud-fields) 

To show columns in list view:

[https://laravel-backpack.readme.io/docs/crud-columns-types](https://laravel-backpack.readme.io/docs/crud-columns-types)