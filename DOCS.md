# DOCUMENTATION

STRIPEUSE LAPIN.ORG API

## Installation

- Install [databaseLapin.sql](https://github.com/noworldausaure/API_Lapin/blob/master/api/dump/databaseLapin.sql)

- Use [Composer](https://getcomposer.org/)
```json
{
    "require": {
        "slim/slim-skeleton": "^3.1",
        "slim/pdo": "~1.9"
    }
}
```

## Function

### GET

#### /infoGeneral

return all info from lapin.info

#### /info/{domain}

return all info from specific domain

#### /strips/{domain}/{id}

return strips from specific domain

*id is optional*

#### /stories/{domain}/{id}

return stories from specific domain

*id is optional*

---

### POST

#### /newDomain

#### /user/login

#### /{domain}/admin



#### /strips/newStrip

Add new strips

Parameters to post:

##### /stories/newStories
Add new stories

Parameters to post:

----


### PUT

#### /update/info

#### /update/strips

#### /update/stories

----

### DELETE
#### /delete/domain

#### /delete/stories

#### /delete/strips

----

## Middleware
Basic login Middleware you have to post your login and password on all request who need admin power.
```php
$mw = function ($request, $response, $next) {
    $dataLog = $request->getParsedBody();
    if(login($dataLog)){
      $response = $next($request, $response);
      return $response;
    }
    else{
      echo 'get Logged';
    }
};
```
add
```php
->add($mw);
```
after your routes
