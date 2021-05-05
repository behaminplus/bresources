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
Create resources and requests with following artisan commands and pass data, message, error_message or count like following example:

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
