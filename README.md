# API Responser

<p align="center">
<a href="https://github.com/soulaimaneyahya/api-responser"><img src="./assets/tests.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/soulaimaneyh/api-responser" target="_blank"><img src="./assets/version.svg" alt="Version"></a>
<a href="https://github.com/soulaimaneyahya/api-responser/blob/main/LICENSE" target="_blank"><img src="./assets/license.svg" alt="License"></a>
</p>

API-Responser is a PHP package that simplifies the process of building APIs

## Installation
Require this package with composer. It is recommended to only require the package for development.

```shell
composer require soulaimaneyh/api-responser --dev
```

## ServiceProvider:

Add the **ApiServiceProvider** to the providers array in config/app.php
```php
// ...
Soulaimaneyh\ApiResponser\Providers\ApiServiceProvider::class
```

To get **X-Application-Name** header, Copy the package config to your local config with the publish command:

```sh
php artisan vendor:publish --tag=api-responser-config
```

## Usage

```php
use \Soulaimaneyh\ApiResponser\Traits\ApiResponser;

class Controller extends BaseController
{
    use ApiResponser;
}
```

UsersController has __construct() method initializes a property apiRepository with an instance of the ApiRepositoryInterface.

`showAll()` method receives **`Collection|JsonResource`** as its param.

`showOne()` method receives **`Model|JsonResource $instance`** as its param.

```php
use \Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface;

class UsersController extends Controller
{
    public function __construct(ApiRepositoryInterface $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    public function index()
    {
        return $this->apiRepository->showAll(User::all());
    }

    public function show(User $user)
    {
        if (!$user instanceof User) {
            return $this->infoResponse('Item Not Found', 404);
        }

        return $this->apiRepository->showOne($user);
    }
}
```

---

Need helps? Reach me out

> Email: contact@soulaimaneyahya.com

> Linkedin: soulaimane-yahya

✨👽
