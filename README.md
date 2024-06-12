# Pedro

Pedro is a robust Laravel-based web application designed to streamline business operations. The project includes features such as user authentication, role-based access control, and a parent-child user hierarchy. These capabilities ensure efficient data visibility and management across different levels of users.

## Features

- **User Authentication**: Secure login and registration.
- **Role-Based Access Control**: Different roles with specific permissions.
- **Parent-Child User Hierarchy**: Allows parent users to manage and view data for their child users.
- **Data Management**: Efficient handling and retrieval of user-specific data.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/DcSyedFaraz/pedro.git
Navigate to the project directory:


cd pedro
Install dependencies:
composer install
npm install
Set up the environment file:


cp .env.example .env
Configure the .env file with your database and other necessary settings.

Generate the application key:


php artisan key:generate
Run the migrations:


php artisan migrate
Usage
Start the local development server:


php artisan serve
Access the application at http://localhost:8000.

Contributing
Feel free to fork this repository and contribute by submitting pull requests. For major changes, please open an issue first to discuss what you would like to change.

License
This project is open-source and available under the MIT License.

Contact
For more information, visit the GitHub repository.
