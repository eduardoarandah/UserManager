# Backpack\UserManager

An admin interface to easily add/edit/remove users, using [Backpack for Laravel](https://backpackforlaravel.com)

## Backpack 4
![user-manager](https://user-images.githubusercontent.com/1032474/70066883-1b288580-15f6-11ea-837d-bdf4eae8d94a.gif)

## Backpack 3
![user-manager](https://user-images.githubusercontent.com/4065733/40717133-e8b5701e-63d0-11e8-9f1d-540500161f64.png)

> ### Security updates and breaking changes
> Please **[subscribe to the Backpack Newsletter](http://backpackforlaravel.com/newsletter)** so you can find out about any security updates, breaking changes or major features. We send an email every 1-2 months.

## Install on Backpack v4.1 (Laravel 6 or Laravel 7)

1) In your terminal:

```bash
composer require eduardoarandah/usermanager
```

2) Add Backpack's CrudTrait on your User model:

By default: app/User.php

```php
namespace App;

class BackpackUser extends User
{
    use Backpack\CRUD\app\Models\Traits\CrudTrait; // <--- Add this line

    // ...
```

3) [Optional] If your User model is NOT `App\User::class` or your users table is not `users`, you should publish this package's config file and correct those assumptions in the `config/eduardoarandah/usermanager.php` file. To publish file, run:

```bash
php artisan vendor:publish --provider="EduardoArandaH\UserManager\UserManagerServiceProvider" --tag='config'
```

4) [Optional] Add a sidebar link

```bash
php artisan backpack:add-sidebar-content "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i class='nav-icon la la-user'></i> <span>Users</span></a></li>"
```
(alternatively, manually add an item in ```resources/views/vendor/backpack/base/inc/sidebar_content.blade.php``` or ```menu.blade.php```)


## Install on Backpack v4.0 (Laravel 6 or Laravel 7)

1) In your terminal:

```bash
composer require eduardoarandah/usermanager
```

2) Add Backpack's CrudTrait on your User model:

By default: app/Models/BackpackUser.php

```php
namespace App\Models;

use App\User;
use Backpack\CRUD\app\Models\Traits\InheritsRelationsFromParentModel;
use Backpack\CRUD\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait; <--- Add this line

class BackpackUser extends User
{
    use InheritsRelationsFromParentModel;
    use Notifiable;
    use CrudTrait; <--- Add this line

    ...
```

3) [Optional] Add a sidebar link

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

## How to extend this package

When you need more control on your user model, the best way is copying the code.

**You can even make your own** CRUD controller with `php artisan backpack:crud user` and simply add `handlePasswordInput` `addFields` methods in `src/app/Http/Controllers/UserCrudController`. [See code](https://github.com/eduardoarandah/UserManager/blob/master/src/app/Http/Controllers/UserCrudController.php)

### To copy source code into your project

Go to `vendor/eduardoarandah/usermanager/src` and copy: 

- Route: `routes/eduardoarandah/usermanager.php` in your `routes/web.php` file
- Controller `app/Http/Controllers/UserCrudController.php` inside your `app/Http/Controllers` folder
- Requests `app/Http/Requests/*` inside your `app/Http/Controllers` folder
- In UserCrudController set the model, example:

	$this->crud->setModel('App\User'));

- In every file, replace my namespace `EduardoArandaH\UserManager\app\Http\Requests` for `App\Http\Requests`

Now you can remove the package with composer: 

``` bash
composer remove eduardoarandah/usermanager
```


## Documentation for fields (updating/creating)

[https://laravel-backpack.readme.io/docs/crud-fields](https://laravel-backpack.readme.io/docs/crud-fields)

## Documentation for columns (list view)

[https://laravel-backpack.readme.io/docs/crud-columns-types](https://laravel-backpack.readme.io/docs/crud-columns-types)


## Upgrade from Backpack 4.0 to 4.1

To successfully use this package after you upgrade your project from Backpack 4.0 to Backpack 4.1, you need to:
- require version ```^3.0``` of this package by changing your ```composer.json``` file or running ```composer require eduardoarandah/usermanager:"^3.0"```;
- (most likely) change the user model in the usermanager config file from ```App\Models\BackpackUser::class``` to ```App\User::class```;
- (less likely) if you've extended the UserCrudController in this package and you've modified the ```handlePasswordInput()``` function, you also need to take account that the crud request in now fetched using setters and getters instead of directly as a property; take a closer look at [Step 11](https://backpackforlaravel.com/docs/4.1/upgrade-guide#step-11) in the Backpack 4.1 upgrade guide, or look at the new code in this package for inspiration;
