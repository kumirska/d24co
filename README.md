### `Directa24` samples for debugging API
#### Country for: Colombia

Create config:

`cp credentials.tpl.php credentials.php`

#### Examples

##### Cashout

`docker run -it --rm --name directa24-running -v "$PWD":/var/www/directa24 -w /var/www/directa24 php:7.4-cli php cashout.php`

##### Cashout Status
`docker run -it --rm --name directa24-running -v "$PWD":/var/www/directa24 -w /var/www/directa24 php:7.4-cli php cashoutStatus.php`
