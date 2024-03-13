# ⛱ Holiday Plans

This project consists of a RESTful API for managing vacation plans and these are some features:

1. User registration, login and logout;
2. Listing, registering, editing and deleting vacation plans;
3. Issuing a PDF report with details of a particular vacation plan;
7. Authentication for handling vacation plans and users;

The folder in the directory contains the project developed in Laravel.

## 💻 Project setup

### 🛫 Initialization

To get started, we first need to initialize the Docker containers by running the following commands in the project root:

```
sudo make run
```

Once the containers are started, the Adminer for managing the database can be accessed via the URL http://localhost:8080.

With the initialization of the project, we already have the popularization of the bank through Factories and Seeders.

All set! It will be possible to make requests using the defined routes.

### 📍 Routes

### Create a user

`POST` http://localhost:8001/api/users
```
{
	"name": "example",
	"email": "example@example.com",
	"password": "1234"
}
```

### Generate token

`POST` http://localhost:8001/api/token
```
{
	"email": "example@example.com",
	"password": "1234"
}
```

### Delete user

`DELETE` http://localhost:8001/api/users/{id}

### Update a user

`PUT` http://localhost:8001/api/users/{id}
```
{
	"name": "example2",
}
```
### Retrieve a specific user by their ID

`GET` http://localhost:8001/api/users/{id}

### Retrieve all users

`GET` http://localhost:8001/api/users/

### Log out

`POST` http://localhost:8001/api/logout

### Create a vacation plan

`POST` http://localhost:8001/api/holiday-plans
```
{
	"title": "Travel to Lisbon",
	"description": "The best city of European",
	"date": "2024-07-07",
	"location": "Portugal",
	"participants": "2"
}
```
### Update a vacation plan

`PUT` http://localhost:8001/api/holiday-plans/{id}
```
{
	"title": "Travel to Porto"
}
```
### Delete a vacation plan

`DELETE` http://localhost:8001/api/holiday-plans/{id}

### Retrieve a specific vacation plan by its ID

`GET` http://localhost:8001/api/holiday-plans/{id}

### Retrieve all vacation plans

`GET` http://localhost:8001/api/holiday-plans/

### Generate PDF of a specific vacation plan

`GET` http://localhost:8001/api/holiday-plans/{id}/pdf

## 🔧 Finalization

To finish the project completely, it is necessary to finish all the containers that have been started.

To finalize the API containers, run the following command in the project root:

```
sudo make stop
```

Note: if you get an error on the first start, end the application and start it again.

## 🏗️ Built with

* [PHP](https://www.php.net/)
* [Laravel](https://laravel.com/)
* [Docker](https://www.docker.com/)

---
Developed by [Yuri Fernandes](https://github.com/fernandesyuri16)

