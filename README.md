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

Use the provided SQLite database to test the API. The database includes preloaded user data, such as usernames and Bearer tokens, which can be used to authenticate and interact with the protected endpoints.
Example credentials:\
`Username: asuku`\
`Bearer Token: 1|kkUoKDwOi1frZkZGDnKIMkf5PDk5kN0U7q3skpiTbf589b52 `\
You can use these credentials to test the lab-tests, submit-medical-data, and logout endpoints.

# Usage
This section will guide you through how authentication is handled using the custom Authentication service in the application. The service provides methods for registering new users and logging in existing users, while using a HttpResponses trait for handling responses.

## GraphQL Command to use
To register a new user, a POST request is sent to the registration endpoint with the following data:


`mutation {
  register(name: "John Doe", username: "johndoe", email: "john@example.com", password: "password")
}`


## Login
To log in a user, a POST request is sent to the login endpoint with the user's email and password. If the credentials are valid, an authentication token is generated and returned.

Example Request:

`mutation {
  login(email: "user@example.com", password: "password")
}`\




## Lab Tests Endpoint
   The lab-tests endpoint provides a paginated list of laboratory tests.

Endpoint:


`query {
  labTests(page: 1) {
    id
    name
    description
  }
}`

## Submit Medical Data Endpoint
   The submit-medical-data endpoint is used to submit medical data for a specific user. This data is then sent via email to peopleoperations@kompletecare.com.

Endpoint:

`mutation {
  submitMedicalData(username: "johndoe", data: ["test1", "test2"])
}`

### Note
