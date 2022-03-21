## Installation
- Create database
- Copy ".env.example" to ".env"
- Change the database name in ".env" file
- Change APP_NAME in ".env" file
- Configure MAIL configurations as follows (Add Email with options "Less Secure Apps" enabled)
    ```bash
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.gmail.com
        MAIL_PORT=587
        MAIL_USERNAME=EMAIL_ADDRESS
        MAIL_PASSWORD=PASSOWORD
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS=EMAIL_ADDRESS
        MAIL_FROM_NAME=${APP_NAME}
    ```
- run the following commands
    ```bash
      composer install
      php artisan migrate --seed
      php artisan key:generate
      php artisan serve
    ```
- login to the system using
    ```bash
        usernme: admin@material.com
        password: secret
    ```
