<div align="center">

<img width="150" height="150" src="./assets/api-responser.svg" alt="API Responser package logo"/>

# API Responser

[![Tests](https://github.com/multividas/api-responser/actions/workflows/tests.yml/badge.svg)](https://github.com/multividas/api-responser/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/multividas/api-responser.svg?style=flat-square)](https://packagist.org/packages/multividas/api-responser)
[![License](https://img.shields.io/github/license/multividas/api-responser?style=flat-square)](https://github.com/multividas/api-responser/blob/main/LICENSE)

</div>

Composer package to facilitates the process of structuring and generating API responses

## Installation

Require this package with composer.

```shell
composer require multividas/api-responser 
```

## ServiceProvider:

**[Optional]** Adding the **ApiResponserServiceProvider** to the providers array in **config/app.php**

```php
\Multividas\ApiResponser\Providers\ApiResponserServiceProvider::class,
```

**[Optional]** To get **X-Application-Name** http response header, Copy the package config to your local config with the publish command:

```sh
php artisan vendor:publish --tag=api-responser-config
```

## Usage

```php
use \Multividas\ApiResponser\Traits\ApiResponser;

class Controller extends BaseController
{
    use ApiResponser;
}
```

### Dependency Injection

PostsController has __construct() method initializes a property apiRepository with an instance of the ApiRepositoryInterface.

`showAll()` method receives **`Collection|JsonResource`** as its param.

`showOne()` method receives **`Model|JsonResource $instance`** as its param.

```php
use \Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;

class PostsController extends Controller
{
    public function __construct(
        public ApiRepositoryInterface $apiRepository
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->apiRepository->showAll(Post::all());
    }

    public function show(Post $post): JsonResponse
    {
        if (!$post instanceof Post) {
            return $this->infoResponse('Item Not Found', 404, []);
        }

        return $this->apiRepository->showOne($post);
    }
}
```

### Facades

Using the `ApiResponser` to access the methods of `ApiRepositoryInterface` in your `PostsController`.

```php
use Multividas\ApiResponser\Facades\ApiResponser;

class PostsController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponser::showAll(Post::all());
    }

    public function show(string $postId): JsonResponse
    {
        $post = Post::find($postId);

        if (!$post instanceof Post) {
            return $this->infoResponse('Post Not Found', 404, (object)[]);
        }

        return ApiResponser::showOne($post);
    }
}
```

This approach provides a cleaner and more organized way to interact with the `ApiRepositoryInterface` instance in your controller methods.

### Success Response

Successful response containing the requested data and an appropriate status code.

```json
{
    "data": [],
    "code": 200,
    "meta": {}
}
```

Learn more: [Multividas API Responser](https://developers.multividas.com/rest/introduction/api-responser)

---

### Run PHPUnit tests

```sh
composer test
```

## 🤝 Contributing

Please read the [contributing guide](https://github.com/multividas/.github/blob/main/CONTRIBUTING.md).

## 🛡️ Security Issues

If you discover a security vulnerability within Multividas, we would appreciate your help in disclosing it to us responsibly, please check out our [security issues guidelines](https://github.com/multividas/.github/blob/main/SECURITY.md).

## 🛡️ License

Licensed under the [MIT license](https://github.com/multividas/.github/blob/main/LICENSE).

---

> Email: multividasdotcom@gmail.com
