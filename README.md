# CabalEngine CMS 1.0.0

CabalEngine is an Open source Content Management System (CMS) for Cabal Online servers. Our main goal is to provide a fast, secure and high quality framework for server owners to create and implement their own features to their websites.

## Getting Started

These instructions will help you deploy your own website using CabalEngine CMS.

### Prerequisites

Here's what you'll need to run CabalEngine CMS in your web server

* Apache mod_rewrite
* PHP 8.1 or higher (8.4 recommended)
* PHP modules: PDO dblib (sybase)/odbc/sqlsrv, cURL, OpenSSL, GD

### Installing

1. Download the latest release of CabalEngine CMS
2. Upload the ZIP file contents to your web server
3. Run CabalEngine CMS Installer by going to `example.com/install` and follow the given instructions
4. Configure the master cron job located at `/includes/cron/cron.php` to run `once per minute`. For more detailed instructions [click here](https://github.com/lautaroangelico/CabalEngine/wiki/Setting-up-the-master-cron-job).

## Other Software

CabalEngineCMS is possible thanks to the following open source projects.

* [WebEngineCMS] (https://github.com/lautaroangelico/WebEngine/)
* [PHPMailer](https://github.com/PHPMailer/PHPMailer/)
* [Bootstrap](https://getbootstrap.com/)
* [jQuery](http://jquery.com/)
* [reCAPTCHA](https://github.com/google/recaptcha)
* [DataTables](https://datatables.net/)
* [SB Admin 2](https://github.com/StartBootstrap/startbootstrap-sb-admin-2)
* [Font-Awesome](https://github.com/FortAwesome/Font-Awesome)
* [MetisMenu](https://github.com/onokumus/metismenu)
* [TinyMCE](https://github.com/tinymce/tinymce)

## CabalEngine (Modification) Author

* **Rooan Oliveira** - *Developer*

## WebEngine Author

* **Lautaro Angelico** - *Developer*

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details