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

- Configure [config-db.php.sample](https://github.com/noworldausaure/API_Lapin/blob/master/api/sql/config-db.php.sample)


---


**TITLE**: Get general info

**URL** : /infoGeneral

**METHOD**:GET

**URL PARAMS**: None

**SUCCESS REPONSE** : 200


---

**TITLE**: Get info from specific domain

**URL** : /info/:domain

**METHOD**:GET

**URL PARAMS**: Required = [domain]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

---


**TITLE**: Get strips from specific domain

**URL** : /strips/:domain/:id

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [id]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one strips if id is set

---

**TITLE**: Get strips from specific domain

**URL** : /stories/:domain/:id

**METHOD**:GET

**URL PARAMS**: Required = [domain] & Optional = [id]

**SUCCESS REPONSE** : 200

**ERROR REPONSE** : 404

**Note** : return one stories if id is set

---

**TITLE**: Create new domain (need admin right)

**URL** : /newDomain

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "short_name":"gluby",
    "large_name":"gluby on ice",
    "author":"Alexande droposki",
    "favicon":"favicon.jpg",
    "login":"admin",
    "pwd":"password"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login


**Note** :
- Create domain database with info strips and stories table on it
- add automatically info on  lapin.info
- add automatically info on the domain.info create
- don't work if the short_name is the same one other domain

---

**TITLE**: login admin

**URL** : /user/login

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "login":"admin",
    "pwd":"password"
}
```

**SUCCESS REPONSE** : 200


---

**TITLE**: login admin on specific  domain

**URL** : /:domain/admin

**METHOD**:POST

**URL PARAMS**: Required = [domain]

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "pwd":"password"
}
```

**SUCCESS REPONSE** : 200


---

**TITLE**: add new strips on specific domain

**URL** : /strips/newStrip

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"an awesomestrips",
    "file":"awesomestrips.jpg",
    "date":"2015-05-19 19:05:15",
    "id_story":"password"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

---

**TITLE**: add new stories on specific domain

**URL** : /Stories/newStories

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"myawesomestories"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

---

**TITLE**: update info

**URL** : /update/info

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "short_name":"glubyraptor",
    "large_name":"Gluby saint raptor",
    "author":"Alexando del raptor",
    "favicon":"raptor.jpg",
    "description":"the beautiful raptor making strips for you",
    "profil_picture":"raptor_pro.jpg",
    "ban_picture":"raptor_ban.jpg",
    "first_pub":"raptor_pub.jpg"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

**Note** :
- automatically change info from lapin.info and domain.info

---

**TITLE**: update strips

**URL** : /update/strips

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"this strips",
    "file":"newstrips.jpg",
    "story_id":1,
    "id":2
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

---

**TITLE**: update strips

**URL** : /update/stories

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby",
    "title":"this stories",
    "id":2
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

---

**TITLE**: drop database domain

**URL** : /delete/domain

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby"
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

---

**TITLE**: delete stories

**URL** : /delete/stories

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby"
    "id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

**Note**:
- you can add the 'withStrip' params(Bool) who with delete all strips affiliate at the id send

---
**TITLE**: delete strips

**URL** : /delete/strips

**METHOD**:POST

**URL PARAMS**: None

**DATA PARAMS**:
```json
{
    "domain":"gluby"
    "id":1
}
```

**SUCCESS REPONSE** : 200

**MIDDLEWARE** : login

**Note**:
- you can add the 'all' params(Bool) who with truncate the table strips of the domain specify

----

## MIDDLEWARE
Basic login MIDDLEWARE you have to post your login and password on all request who need admin right.
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
