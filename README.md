<div id="top"></div>

[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://ismaelocho@github.com/ismaelocho/laravel-import-csv/">
    <img src="images/logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">laravel-import-csv</h3>


</div>

<!-- ABOUT THE PROJECT -->
## About The Project

The purpose of this project is to have a system with user authentication, who upon accessing have the option of uploading a csv or xls file to upload products and then assigning them a predefined category in the system, implementing filters for security and user errors.

Objetives:
* Have a user registration and authentication system.
* Use queues and jobs to process file uploads and extract data.
* Send notification email upon completion of processing of uploaded files.


### Built With

Built with the Laravel 9 framework and Livewire


* [![Laravel][Laravel.com]][Laravel-url]


<p align="right">(<a href="#top">back to top</a>)</p>



### Prerequisites

The prerequisites that must be met in order to run this application are listed.
* PHP 7.4^
* MySQL | MariaDB
* Composer 2.3^
* npm
  ```sh
  npm install npm@latest -g
  ```

### Installation

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._


1. Clone the repo
   ```sh
   git clone https://github.com/ismaelocho/laravel-import-csv.git
   ```
2. Add .env file and setup database and Queue connection
   ```sh
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=aldea
    DB_USERNAME=imroot
    DB_PASSWORD=thepassword

    QUEUE_CONNECTION=database

    MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=XXX
   MAIL_PASSWORD=XXX
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="admin@laravel.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```
3. point to the repository using cmd & run
   ```sh
   composer update
   ```
4. run "php artisan jwt:secret"
   ```sh
   php artisan jwt:secret
   ```
5. run migration 
   ```sh
   php artisan migrate
   ```
6. run migration & category seeder
   ```sh
   php artisan migrate:refresh --seed
   ```
7. run to compile objects
   ```sh
   npm install && npm run dev
   ```

### QUEUE Notes

_To run the queuing process run the command

   ```sh
   php artisan queue:work
   ```

### Send Email Notes

_It is recommended to use the mailtrap.io service to test sending emails in a test environment.



<p align="right">(<a href="#top">back to top</a>)</p>





<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/ismael-ochoa-jul1986/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com