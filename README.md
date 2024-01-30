# Bookstore REST API documentation

Manage your bookstore with this API that handles books, orders, users, categories and authors. Built with PHP (latest PHP version 8.2), this API provides a robust foundation for your online bookstore, including admin panel.

Features:

Manage books, authors and categories: Create, read, update, and delete items
Process orders: Create, track, and change statuses for orders
Handle users: Register, login, and manage users profiles and levels as administrator

## Starting server

First of all you need to install MAMP or XAMPP. Now you need to clone this repo into MAMP/XAMPP folder called htdocs. In phpMyAdmin page which you access by starting server, import SQL database.

## API using instructions

### Books

- GET
  - get all books (http://localhost/bookstore/books).
    Example for response:
    ```
     [
      {
          "id": 15,
          "title": "Learning Python Network Programming",
          "description": ...,
          "pages": 320,
          "year": 2015,
          "language": "en",
          "price": 391,
          "isbn": "1784391158",
          "authorId": 114,
          "author": "Sam Washington",
          "categoryId": 19,
          "category": "Computers"
      },
     ...
    ]
    ```
  - get one book (http://localhost/bookstore/books/:id).
    Example for response:
    ```
      {
        "id": 15,
        "title": "Learning Python Network Programming",
        "description": ...,
        "pages": 320,
        "year": 2015,
        "language": "en",
        "price": 391,
        "isbn": "1784391158",
        "authorId": 114,
        "author": "Sam Washington",
        "categoryId": 19,
        "category": "Computers"
    }
    ```
  - get top books (http://localhost/bookstore/top-books)
    Example for response: (similar as books has)
- POST
  - add new book (http://localhost/bookstore/books)
    send an object
    ```
    {
      "title": "test",
      "description": "test",
      "pages": 10,
      "year": 2023,
      "language": "test",
      "authorId": 1,
      "categoryId": 1,
      "price": 100,
      "isbn": "012345678"
    }
    ```
    authorId and categoryId must exist in database. Example for response:
    ```
    {
        "message": "Book is created",
        "id": 48
    }
    ```
- PUT
  - update the book (http://localhost/bookstore/books/:id)
    send an object
    ```
    {
      "title": "test",
      "description": "test",
      "pages": 10,
      "year": 2023,
      "language": "test",
      "authorId": 1,
      "categoryId": 1,
      "price": 100,
      "isbn": "012345678"
    }
    ```
    Example for response:
    ```
    {
        "message": "Book with ID = id has been updated"
    }
    ```
- DELETE
  - delete the book (http://localhost/bookstore/books/:id)

### Categories

- GET
  - get all categories (http://localhost/bookstore/categories).
    Example for response:
    ```
     [
      {
        "id": 9,
        "name": "Social Science",
        "created": 1706458616,
        "modified": null,
        "booksAmount": 1
      },
     ...
    ]
    ```
  - get one category (http://localhost/bookstore/categories/:id).
    Example for response:
    ```
    {
        "id": 9,
        "name": "Social Science",
        "books": [
            {
                "bookId": 35,
                "title": "Gratislunchen",
                "imgUrl": "http://books.google.com/books/content?id=xVMGCwAAQBAJ&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api",
                "price": 110,
                "category": "Social Science"
            }
        ]
    }
    ```
- POST
  - add new category (http://localhost/bookstore/categories)
    send an object
    ```
    {
      "name":"Deckare"
    }
    ```
    Example for response
    ```
    {
        "message": "Category is created",
        "id": 10
    }
    ```
- PUT
  - update the book (http://localhost/bookstore/categories/:id)
    send an object
    ```
    {
      "name":"Fantasy"
    }
    ```
    Example for response:
    ```
    {
        "message": "Category with ID = id has been updated"
    }
    ```
- DELETE
  - delete the category (http://localhost/bookstore/categories/:id)

### Authors

- GET
  - get all authors (http://localhost/bookstore/authors).
    Example for response:
    ```
     [
      {
        "id": 101,
        "name": "L. G. Nilsson",
        "created": 1706458601,
        "modified": null
      },
     ...
    ]
    ```
  - get one author (http://localhost/bookstore/authors/:id).
    Example for response:
    ```
    {
      "id": 101,
      "name": "L. G. Nilsson",
      "created": 1706458601,
      "modified": null
    }
    ```
- POST
  - add new author (http://localhost/bookstore/authors)
    send an object
    ```
    {
      "name":"FirstName LastName"
    }
    ```
    Example for response
    ```
    {
        "message": "Author is created",
        "id": 10
    }
    ```
- PUT
  - update the author (http://localhost/bookstore/authors/:id)
    send an object
    ```
    {
      "name":"FirstName2 LastName2"
    }
    ```
    Example for response:
    ```
    {
        "message": "Author with ID = id has been updated"
    }
    ```
- DELETE
  - delete the author (http://localhost/bookstore/authors/:id)

### Users

- GET
  - get all users (http://localhost/bookstore/users).
    Example for response:
    ```
     [
      {
        "id": 1,
        "firstName": "Sergejs",
        "lastName": "Voronins",
        "accountLevel": "level",
        "address": "adress",
        "zip": "12345",
        "city": "city",
        "mobile": "number",
        "email": "email",
        "created": 1703588794,
        "modified": null
      },
     ...
    ]
    ```
  - get one user (http://localhost/bookstore/users/:id).
    Example for response:
    ```
    {
      "id": 1,
      "firstName": "Sergejs",
      "lastName": "Voronins",
      "accountLevel": "level",
      "address": "adress",
      "zip": "12345",
      "city": "city",
      "mobile": "number",
      "email": "email",
      "created": 1703588794,
      "modified": null
    }
    ```
- POST
  - add new user (http://localhost/bookstore/users)
    send an object
    ```
    {
      "password": "password",
      "email": "test1@test.se"
    }
    ```
    Example for response
    ```
    {
      "message": "User is created",
      "id": 10
    }
    ```
- PUT
  - update the user (http://localhost/bookstore/users/:id)
    send an object
    ```
    {
      "firstName": "testName",
      "lastName": "lastName",
      "address": "address",
      "zipCode": "code",
      "city": "city",
      "mobile": "mobile"
    }
    ```
    All properties could be null.
  - update user level (http://localhost/bookstore/user-level/:id). For admin uses
    send an object
    ```
    {
      "accountLevel": "admin"
    }
    ```
  - update user PASSWORD (http://localhost/bookstore/user-password/:id).
    send an object
    ```
    {
      "oldPassword": "qwerty",
      "password": "qwert"
    }
    Example for response:
    ```
    {
    "message": "User with ID = id has been updated"
    }
- DELETE
  - delete the user (http://localhost/bookstore/users/:id)

### Orders

- GET
  - get all orders
    - for guests (http://localhost/bookstore/orders).
    - for users (http://localhost/bookstore/user-orders).
      Example for response:
    ```
     [
      {
        "id": 24,
        "orderStatus": "new",
        "orderDate": 1706462443
      },
     ...
    ]
    ```
  - get one order
    - for guest orders (http://localhost/bookstore/orders/:id).
      Example for response:
      ```
      {
        "id": 24,
            "orderDate": 1706462443,
            "totalPrice": 914,
            "shipmentId": 32,
            "orderStatus": "new",
            "Modified": null,
            "shipmentDetails": {
                "firstName": "Anstasia",
                "lastName": "Khitsjo",
                "address": "Vilkengata 1",
                "zipCode": "14250",
                "city": "Skogås",
                "mobile": "54979794",
                "email": "a@test.se",
                "created": 1706462443,
                "modified": null
            },
            "books": [
                {
                    "bookId": 42,
                    "title": "Dubbelsäng i Danmark",
                    "amount": 1,
                    "bookPrice": 157
                },
                ...
            ]
      }
      ```
    - for users orders (http://localhost/bookstore/user-order/:id).
      Example for response:
      ```
      {
        "id": 9,
        "orderDate": 1706463933,
        "totalPrice": 741,
        "userId": 3,
        "shipmentId": 36,
        "orderStatus": "new",
        "Modified": null,
        "shipmentDetails": {
            "firstName": "Anstasia",
            "lastName": "Voronins",
            "address": "Russinvägen 1",
            "zipCode": "12359",
            "city": "Farsta",
            "mobile": "726564865",
            "email": "test@test.se",
            "created": 1706463933,
            "modified": null
        },
        "books": [
            {
                "bookId": 18,
                "title": "Pas på, Katja",
                "amount": 1,
                "bookPrice": 157
            },
            ...
        ],
        "userinfo": {
            "firstName": "Anastasia",
            "lastName": "Voronins",
            "accountLevel": "user",
            "address": "Russinvägen 1",
            "zip": null,
            "city": "Farsta",
            "mobile": "0765647987",
            "email": "test@test.se"
        }
      }
      ```
- POST
  - add new order
    - for guest orders (http://localhost/bookstore/orders)
      send an object
      ```
      {
        "totalPrice": 100,
        "shipmentId": 20,
        "books": [{
            "bookId": 1,
            "amount": 1
        }]
      }
      ```
    - for user orders (http://localhost/bookstore/user-orders)
      send an object
      ```
      {
        "totalPrice": 100,
        "userId": 3,
        "shipmentId": 20,
        "books": [{
            "bookId": 1,
            "amount": 1
        },
        ...
        ]
      }
      ```
      Example for response
    ```
    {
        "message": "Order is created",
        "id": 10
    }
    ```
- PUT
  - update order
    - for guest orders (http://localhost/bookstore/orders/:id)
    - for users orders (http://localhost/bookstore/user-orders/:id)
      send an object
      ```
      {
         "orderStatus":"send"
      }
      ```
      order statuses:
    ```
    {
      "new",
      "processing",
      "shipped",
      "completed",
      "canceled",
      "returned",
    }
    ```
    Example for response:
    ```
    {
        "message": "Order with ID = id has been updated"
    }
    ```

### Shipment

- POST
  - add the shipment (http://localhost/bookstore/shipments)
    send an object
    ```
    {
      "firstName": "firstTest",
      "lastName": "lastTest",
      "address": "testAddress",
      "zipCode": "12345",
      "city": "testCity",
      "mobile": "0712345678",
      "email": "testEmail"
    }
    ```
    Example for response:
    ```
    {
      "message": "Shipment with ID = id has been updated"
    }
    ```
  - delete shipment (http://localhost/bookstore/shipments/:id)

### User login

- POST
  - check if the email exist -> make password validation (http://localhost/bookstore/shipments)
    send an object
    ```
    {
      "email": "sergejs.voronins@medieinstitutet.se",
      "password": "qwerty"
    }
    ```
    Example for response:
    ```
    {
      "id": 1,
      "accountLevel": "admin"
    }
    ```

### Search

- GET
  - get all search books (http://localhost/bookstore/search?q=text).
    Example for response: similar as for books
