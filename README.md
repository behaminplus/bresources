[![License](https://poser.pugx.org/behamin/bresources/license)](//packagist.org/packages/behamin/bresources)
[![Tests](https://github.com/omalizadeh/bresources/actions/workflows/tests.yml/badge.svg)](https://github.com/omalizadeh/bresources/actions/workflows/tests.yml)
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
    "message": "message",
    "error": {
        "message": "or error message",
        "errors": null
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
    "message": null,
    "error": {
        "message": null,
        "errors": null
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
        "errors": {
            "password": [
                "password field is required."
            ]
        }
    }
}
```

## Usage

Create resources and requests with artisan commands and pass data, message, error_message or count to resources like
following examples:

```php
    public function index(EmailFilter $filters)
    {
        list($emails, $count) = Email::filter($filters);
        $emails = $emails->get();
        
        return EmailResource::collection(['data' => $emails, 'count' => $count]);
    }
```

```php
    public function show(Email $email)
    {
        return new EmailResource(['data' => $email, 'message'=> 'email info.']);
    }
```

You can specify output fields from transformDataItem() method of resource classes.

```php
<?php

namespace App\Http\Resources;

use Behamin\BResources\Resources\BasicResource;

class EmailResource extends BasicResource
{
    protected function transformDataItem($item)
    {
        return [
            'id' => $item->id,
            'email' => $item->email,
            'status' => $item->status
        ];
    }
}

```

Also, you can use apiResponse() helper function to directly send response

```php
class PhoneController {

    public function show(Phone $phone)
    {
        return apiResponse()->data($phone)->message('phone info.')->status(200)->get();
    }
    
    public function index() {
        $phones = Phone::all();
        
        return apiResponse()->collection($phones, $phones->count())->message('phone info.')->status(200)->get();
    }
    
    public function update(Request $request, Phone $phone) {
        $isUpdated = $phone->update($request->all());
        
        if (!$isUpdated) {
            return apiResponse()->errors('phone is not updated');
        }
        
        return apiResponse()->data($phone)->message('phone is updated')->get();
    }
    
    public function delete(Phone $phone)
    {
        $phone->delete();
        
        return apiResponse()->message('phone info.')->next('https://debut.test')->status(200)->get();
    }
}
```

In above example **message** and **status** are optional, and their default value respectively are `null` and `200`.

#### Resource

```bash
php artisan make:bresource ResourceClassName
```

#### Request

```bash
php artisan make:brequest RequestClassName
```
