## User REST API Methods

### Create User

-   **Description:** Создание нового пользователя.
-   **Endpoint:** /api/users
-   **HTTP Method:** POST
-   **Request Body:** {
    "name": "string, max:50",
    "email": "string",
    "password": "string",
    "password_confirmation": "string, same:password"
    }
-   **Response:** {
    "user": {
    "id": int,
    "name": string,
    "email": string
    },
    "token": string
    }

### Update User Information

-   **Description:** Обновление данных пользователя.
-   **Endpoint:** /api/users/{userId}
-   **HTTP Method:** PUT
-   **Request Body:** {
    "id": "int, exist:users tabel"
    "name": "string, max:50",
    "email": "string",
    "password": "string",
    }
-   **Response:**{
    "message": "Данные пользователя обновлены."
    }

### Delete User

-   **Description:** Удаление пользователя.
-   **Endpoint:** /api/users/{userId}
-   **HTTP Method:** DELETE
-   **Response:** {
    "message": "Пользователь удален."
    }

### User Authentication

-   **Description:** Authenticates a user.
-   **Endpoint:** /api/authenticate
-   **HTTP Method:** POST
-   **Request Body:** {
    "email": "string",
    "password": "string",
    }
-   **Response:** {
    "user": {
    "id": int,
    "name": string,
    "email": string
    },
    "token": string
    }

### Get User Information

-   **Description:** Retrieves information about a user.
-   **Endpoint:** /api/users/{userId}
-   **HTTP Method:** GET
-   **Response:**
    {
    "data": {
    "id": int,
    "name": string,
    "email": string
    }
    }
