# API Responser

API-Responser is a PHP package that simplifies the process of building APIs


## Usage

```php
class Controller extends BaseController
{
    use ApiResponser;
}
```

The code defines a PHP class UsersController that extends a Controller class and has two public methods, index() and show(). The __construct() method initializes a property apiRepository with an instance of the ApiRepositoryInterface and the index() and show() methods use this property to retrieve and return data from the database.

```php
class UsersController extends Controller
{
    public function __construct(
        protected ApiRepositoryInterface $apiRepository
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

The API endpoint will respond with a JSON object that contains a status field, a message field, a data field, and a statusCode field. The status field will indicate the success or failure of the request, while the message field will provide additional details about the result. The data field will contain any additional data that is returned by the endpoint. The statusCode field will contain the HTTP status code for the response.

Here is an example of a successful response:

```json
{
    "data": {
        "id": 8,
        "name": "Mr. Domenick Stroman I",
        "email": "legros.juana@example.org"
    }
}
```

Otherwise

```json
{
    "error": "Item Not Found",
    "code": 404
}
```

---

Need helps? Reach me out

> Email: soulaimaneyahya1@gmail.com

> Linkedin: soulaimane-yahya

All the best :beer:

