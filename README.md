# API Responser

<p align="center">
<a href="https://github.com/soulaimaneyahya/api-responser"><img src="./assets/tests.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/soulaimaneyh/api-responser"><img src="./assets/version.svg" alt="Version"></a>
<a href="https://github.com/soulaimaneyahya/api-responser"><img src="./assets/license.svg" alt="License"></a>
</p>

API-Responser is a PHP package that simplifies the process of building APIs

## Installation
Require this package with composer. It is recommended to only require the package for development.

```shell
composer require soulaimaneyh/api-responser --dev
```

# ServiceProvider:

Add the **ApiServiceProvider** to the providers array in config/app.php
```php
[
    ApiServiceProvider::class,
]
```

To get **X-Application-Name** header, Copy the package config to your local config with the publish command:

```sh
php artisan vendor:publish --tag=api-responser-config
```

## Usage

```php
class Controller extends BaseController
{
    use \Soulaimaneyh\ApiResponser\Traits\ApiResponser;
}
```

The code defines a PHP class UsersController that extends a Controller class and has two public methods, index() and show(). The __construct() method initializes a property apiRepository with an instance of the ApiRepositoryInterface and the index() and show() methods use this property to retrieve and return data from the database.

```php
class UsersController extends Controller
{
    public function __construct(
        protected \Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface $apiRepository
    ) {
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

## Response format

Response: [200]

```json
{
    "data": {
        "id": 8,
        "name": "Mr. Domenick Stroman I",
        "email": "legros.juana@example.org"
    }
}
```

Response: [404]

```json
{
    "error": "Item Not Found",
    "code": 404
}
```

### Filters

```
GET /products?filters[0][field]=status&filters[0][value]=active&filters[1][field]=vendor&filters[1][value]=soulaimaneyahya
```

### Paginate

Use `page` and optionally `per_page` to paginate returned data.

In the `Link` header you'll get `first`, `prev`, `next` and `last` links.


```
GET /products?page=7
GET /products?page=7&per_page=20
```

_10 items are returned by default_

### Sort

Add `_sort` and `_order` (ascending order by default)

```
GET /products?_sort=id&_order=asc
GET /products?_sort=price&_order=asc
```

---

Need helps? Reach me out

> Email: soulaimaneyahya1@gmail.com

> Linkedin: soulaimane-yahya

All the best :beer:

