# Backpack\UserManager

An admin interface to easily add/edit/remove users, using [Backpack for Laravel](https://backpackforlaravel.com)

![user-manager](https://user-images.githubusercontent.com/4065733/40717133-e8b5701e-63d0-11e8-9f1d-540500161f64.png)

> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.


## Install on Backpack v4 (Laravel 6)

1) In your terminal:

```bash
composer require eduardoarandah/usermanager
```

2) Use Backpack's CrudTrait on your User model:
```php
<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable; 

class User extends Authenticatable
{
    use Backpack\CRUD\app\Models\Traits\CrudTrait; // <----- this    

    /**
     * Your User Model content
     */
```

4) [Optional] Add a menu item for it:

```bash
php artisan backpack:add-sidebar-content "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon fa fa-user'></i> <span>Users</span></a></li>"
```
(alternatively, manually add an item in ```resources/views/vendor/backpack/base/inc/sidebar_content.blade.php``` or ```menu.blade.php```)


## Install on Backpack v3 (Laravel 5)

1) In your terminal:

```bash
composer require eduardoarandah/usermanager
```

2) For Laravel <5.5, add the service provider to your config/app.php file:
```php
EduardoArandaH\UserManager\UserManagerServiceProvider::class,
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

4) [Optional] Add a menu item for it:

```bash
php artisan backpack:base:add-sidebar-content "<li><a href='{{ backpack_url('user') }}'><i class='fa fa-user'></i> <span>Users</span></a></li>"
```
(alternatively, manually add an item in ```resources/views/vendor/backpack/base/inc/sidebar_content.blade.php``` or ```menu.blade.php```)

## How to add/remove fields

Copy source code into your project

- Go to ```vendor/eduardoarandah/usermanager/src```
- Copy CODE in ```routes/eduardoarandah/usermanager.php``` in your ```routes/web.php``` file
- Copy FILE ```app/Http/Controllers/UserCrudController.php``` inside your ```app/Http/Controllers``` folder
- In UserCrudController set the model, example:

	$this->crud->setModel('App\User'));

Now you can remove the package with composer

``` bash
composer require backpack/usermanager
```

Documentation for fields (updating/creating)

[https://laravel-backpack.readme.io/docs/crud-fields](https://laravel-backpack.readme.io/docs/crud-fields) 

Documentation for columns (list view)

[https://laravel-backpack.readme.io/docs/crud-columns-types](https://laravel-backpack.readme.io/docs/crud-columns-types)
