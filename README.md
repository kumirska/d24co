### `Directa24` samples for debugging API
Country for: Colombia

• Fill `credentials.php` with API credentials

• Run `docker run -it --rm --name directa24-running -v "$PWD":/var/www/directa24 -w /var/www/directa24 php:7.4-cli php cashOut.php`
