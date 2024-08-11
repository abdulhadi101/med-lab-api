# Requirement
- Laravel 8.x or later
- PHP 7.4 or later
- Composer


# Installation
To set up the project locally, follow these steps:

Clone the Repository


`git clone https://github.com/your-username/your-project.git
cd your-project`\
### Install Dependencies

Run the following command to install all the necessary dependencies:


`composer install`\
### Environment Configuration

Copy the .env.example file to .env and configure it with your environment settings:


`cp .env.example .env`
Ensure that you set up your database connection in the .env file. If you are using SQLite, make sure to create the SQLite file:


`touch database/database.sqlite`
### Database Setup

The repository comes with a pre-configured SQLite database that includes test user data, including usernames and Bearer tokens. This can be used for testing the API endpoints without setting up a new database from scratch.

If you need to migrate the database or seed it, you can run:

`php artisan migrate --seed`\

### Generate Application Key

Generate a new application key:


`php artisan key:generate`

### Serve the Application

Start the development server:

`php artisan serve` \

### Testing the API
There are two implementation one for normal Rest API, while the other is for GraphQL using Lighthouse-php,
### GraphQL Implmentation
The GraphQl Implementation is on the graphql-lighthouse branch

### Rest API
Use the provided SQLite database to test the API. The database includes preloaded user data, such as usernames and Bearer tokens, which can be used to authenticate and interact with the protected endpoints.
Example credentials:\
`Username: asuku`\
`Bearer Token: 1|kkUoKDwOi1frZkZGDnKIMkf5PDk5kN0U7q3skpiTbf589b52 `\
You can use these credentials to test the lab-tests, submit-medical-data, and logout endpoints.

# Usage
This section will guide you through how authentication is handled using the custom Authentication service in the application. The service provides methods for registering new users and logging in existing users, while using a HttpResponses trait for handling responses.

## Registration
To register a new user, a POST request is sent to the registration endpoint with the following data:


`{
"name": "John Doe",
"username": "johndoe",
"email": "john.doe@example.com",
"password": "securepassword"
}`

Example Request:


`POST /api/register
Content-Type: application/json`

`{
"name": "John Doe",
"username": "johndoe",
"email": "john.doe@example.com",
"password": "securepassword"
}`


Expected Response:

Success: The user is successfully created.

`
{
"status": "success",
"message": "User Created"
}`\
Error: If there is an issue during register, an error response is returned.


`{
"status": "error",
"code": 401,
"message": "Something went wrong",
"data": "Error message"
}`
## Login
To log in a user, a POST request is sent to the login endpoint with the user's email and password. If the credentials are valid, an authentication token is generated and returned.

Example Request:

`POST /api/login
Content-Type: application/json

{
"email": "john.doe@example.com",
"password": "securepassword"
}`\



Expected Response:

Success: The user is authenticated, and a token is returned.


`{
"status": "success",
"code": 201,
"message": "Auth Token",
"data": "Bearer your-generated-token"
}`\
Error: If the credentials are invalid, an error response is returned.


`{
"status": "error",
"code": 401,
"message": "Invalid Credentials",
"data": ""
}`

## Lab Tests Endpoint
   The lab-tests endpoint provides a paginated list of laboratory tests.

Endpoint:


`GET /api/lab-tests
Authorization: Bearer {your-token}`
Example Request:

`GET /api/lab-tests
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...`
\

Expected Response:

Success: A paginated list of lab tests is returned.


`{
"data": [
{
"id": 1,
"name": "Chest",
"created_at": "2024-08-09T12:34:56.000000Z",
"updated_at": "2024-08-09T12:34:56.000000Z"
},
{
"id": 2,
"name": "Cervical Vertebrae",
"created_at": "2024-08-09T12:34:56.000000Z",
"updated_at": "2024-08-09T12:34:56.000000Z"
},
...
],
"links": {
"first": "http://yourapp.test/api/lab-tests?page=1",
"last": "http://yourapp.test/api/lab-tests?page=10",
"prev": null,
"next": "http://yourapp.test/api/lab-tests?page=2"
},
"meta": {
"current_page": 1,
"from": 1,
"last_page": 10,
"path": "http://yourapp.test/api/lab-tests",
"per_page": 15,
"to": 15,
"total": 150
}
}` \
Error: If the token is invalid or missing, a 401 Unauthorized response is returned.

`
{
"message": "Unauthenticated."
}`
## Submit Medical Data Endpoint
   The submit-medical-data endpoint is used to submit medical data for a specific user. This data is then sent via email to peopleoperations@kompletecare.com.

Endpoint:

`POST /api/submit-medical-data
Authorization: Bearer {your-token}
Content-Type: application/json`
Example Request:

`POST /api/submit-medical-data
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
Content-Type: application/json

{
"username": "john_doe",
"data": ["Test Result 1", "Test Result 2", "Test Result 3"]
}`
Expected Response:

Success: The medical data is submitted successfully, and a confirmation message is returned.


`{
"message": "Data submitted successfully"
}`
Error: If the user is not found or there is an issue with the request, an appropriate error response is returned.


`{
"error": "User not found."
}`
or


`{
"error": "An error occurred: [error message]"
}`

### Unit Test
Five unit test was also written to test the functionality of the endpoints

`$ php artisan test`

   PASS  Tests\Feature\LabTestControllerTest
  ✓ test_lab_tests_endpoint_requires_authentication
  ✓ test_submit_medical_data_endpoint_requires_authentication
  ✓ test_authenticated_user_can_access_lab_tests_endpoint
  ✓ test_authenticated_user_can_submit_medical_data
  ✓ test_user_can_logout

  Tests:  5 passed
  Time:   1.87s


#### Note
This the test uses the same database, so it should be ran after testing the api, if not all data it will get wiped out after running the tes
