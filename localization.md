# Localization

##### For Rangitaki version 1.0.0

Translating Rangitaki in another language is quite simple, because most of the stuff is set in the config.php. There are just a few strings that are left to translate. Three to be exact.

A language file looks like this:

```
<?php
// Rangitaki Project
// LANGUAGE: ENGLISH

$BLOGLANG = [
    "Blogs on" => "Blogs on",
    "Check out this blog" => "Check out this blog:",
    "Check out" => "Check out:",
];
```

The only thing that need to be translated are the words between the marks on the right side of the arrows. NEVER change anyting else.

Save the translated file as *ln.php*, where ln is your language in short form, just two letters (e.g. en for english, de for german).

Then commit your changes to GitHub (see the contributing documentation <!--TODO link-->) or send it to marcelmichaelkapfer@yahoo.co.nz.
