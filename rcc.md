# RCC Documentation

##### For Rangitaki version 1.0.0

## Content

 1. Initializing
 
 2. Usage

## 1 Initializing

The RCC is not enabled by default, because you have to set a password first.

Open the file at `/rcc/password.php` and change the password variable to your password. Storing your password in this PHP file secure, because your PHP web server renders the file if someone accesses it and since the password is just saved in a variable but not printed, no one can see it through the web.

After you set the password open your `/config.php` and enable the RCC by setting `$rcc = "yes";`

Access now the website at *http://yourdomain.tl/blog/rcc* and see if it works.

## 2 Usage

In Rangitaki 1.0.0 the RCC has only one functionality: Uploading posts files (*.md*). Select the blog first and the click on "Browse", select your file and click on upload. You see a message, if the upload was possible.
