## Login authentication with social media

This project for the login authentication with social media like facebook, twitter, linkedin, gmail etc.

## Installation and Configuration of Socialite

1. Install the composer:
    ```shell
    composer install
    ```

2. Copy the .env from .env.example using ``` cp .env.example .env ```.

3. Setup database into environment file.

4. Socialite App registration:
    1. For Facebook :
            We do this by going to Facebook’s developers URL: https://developers.facebook.com/ and log in with your Facebook account.
            Go to ‘My Apps’, proceed to ‘Add New App’…
    2. For Gmail :
             We do this by going to Google’s developers URL: http://console.developers.google.com/ and log in with your Gmail account.
            Go to ‘Projects’, proceed to ‘Add New Project’...
    3. For Linkedin :
            We do this by going to Linkedin’s developers URL: https://www.linkedin.com/developers/login and log in with your Linkedin account.
            Go to ‘My Apps’, proceed to ‘Add New App’…
   4. For Twitter : 
        We do this by going to Twitter’s developers URL: https://developer.twitter.com/en and log in with your Twitter account.
        Go to ‘Apps’, proceed to ‘Add New App’…

5. If you have already .env file into root folder of the project then please append below code :
    ```
    FACEBOOK_CLIENT_ID=
    FACEBOOK_CLIENT_SECRET=
    FACEBOOK_URL=http://localhost:8000/login/facebook/callback

    TWITTER_CLIENT_ID=
    TWITTER_CLIENT_SECRET=
    TWITTER_URL=http://localhost:8000/login/twitter/callback

    GOOGLE_CLIENT_ID=
    GOOGLE_CLIENT_SECRET=
    GOOGLE_URL=http://localhost:8000/login/google/callback

    LINKEDIN_CLIENT_ID=
    LINKEDIN_CLIENT_SECRET=
    LINKEDIN_URL=http://localhost:8000/api/oauth/linkedin/callback
    ```
6. Add the social media created Apps ``CLIENT_ID`` ``CLIENT_SECRET`` and ``REDIRECT URL`` of Apps into the above added .env file content.

7. The migration with basic seeder:
   ```
   php artisan migrate
   ```
 
## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email vishal@viitorcloud.com or ruchit.patel@viitor.cloud or shailesh.jakhaniya@viitor.cloud instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
