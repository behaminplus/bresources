[![License](https://poser.pugx.org/behamin/bresources/license)](//packagist.org/packages/behamin/bresources)
[![Latest Stable Version](https://poser.pugx.org/behamin/bresources/v)](//packagist.org/packages/behamin/bresources)
[![Total Downloads](https://poser.pugx.org/behamin/bresources/downloads)](//packagist.org/packages/behamin/bresources)

# Behamin Resources
Behamin standard formats for api responses.

## Installation
```bash
composer require behamin/bresources
```

## Output Format
Resources:
```json
{
    "data": {
        "id": 1,
        "email": "test@test.com"
    },
    "message": "message goes here",
    "error": {
        "message": "error message",
        "errors": []
    }
}
```
ResourceCollection:
```json
{
    "data": {
        "items": [],
        "count": 0,
        "sum": null
    },
    "message": "message goes here",
    "error": {
        "message": "error message",
        "errors": []
    }
}
```
On validation error for requests (with 422 status code):
```json
{
    "data": null,
    "message": null,
    "error": {
        "message": "first error message in message bag",
        "errors": []
    }
}
```

## Usage
Create resources and requests with artisan commands and pass data, message, error_message or count to resources like following examples:

```php
    list($emails, $count) = Email::filter($filters);
    $emails = $emails->get();
    return response(new EmailResourceCollection(['data' => $emails, 'count' => $count]));
```

```php
    public function show(Phone $phone)
    {
        return response(new PhoneResource(['data' => $phone, 'message'=> 'phone info.']));
    }
```
You can specify output fields from getArray() method of resource classes. Set transform variable as true so that resource class converts data using specified fields.
```php
<?php

namespace App\Http\Resources;

use Behamin\BResources\Resources\BasicResource;

class PhoneResource extends BasicResource
{
    public function __construct($resource)
    {
        parent::__construct($resource, true);
    }

    protected function getArray($resource)
    {
        return [
            'id' => $resource->id,
            'phone' => $resource->phone,
            'status' => $resource->status
        ];
    }
}

```
 
#### Resource
```bash
php artisan make:bresource ResourceName
```

#### Resource Collection
For Resource and ResourceCollection (With same output):
```bash
php artisan make:bresource ResourceName --collection
```
ResourceCollection Only:
```bash
php artisan make:bresource RescourceNameCollection
```
Or:
```bash
php artisan make:bcresource RescourceCollectionName
```
#### Request
```bash
php artisan make:brequest RequestName
```
