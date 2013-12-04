Laravel4-SirTrevorJS
====================

Integrate the tool [Sir Trevor JS](http://madebymany.github.io/sir-trevor-js/) in a project, with stylesheets and scripts, and possibility to param it (next evolution).

## Installation

This package is available through Packagist and Composer.

Add `"caouecs/sirtrevorjs": "dev-master"` to your composer.json or run `composer require caouecs/sirtrevorjs`. Then you have to add `"Caouecs\Sirtrevorjs\SirtrevorjsServiceProvider"` to your list of providers in your `app/config/app.php`, and a list of elements for aliases (not all mandatory) :

    'SirTrevorJs'           => 'Caouecs\Sirtrevorjs\SirTrevorJs',
    'SirTrevorJsConverter'  => 'Caouecs\Sirtrevorjs\SirTrevorJsConverter'

So, I recommend you use [Package Installer](https://github.com/rtablada/package-installer), Laravel4-SirTrevorJS has a valid provides.json file. After installation of Package Installer, just run `php artisan package:install caouecs/sirtrevorjs` ; the lists of providers and aliases will be up-to-date.

Next, you must migrate assets and config :

    php artisan asset:publish caouecs/sirtrevorjs

    php artisan config:publish caouecs/sirtrevorjs


## Configuration file

After installation, the config file is located at *app/config/packages/caouecs/sirtrevorjs/sir-trevor-js.php*.

You can define :

* the path for image upload
* the path of Sir Trevor files (if you don't use the files by default)
* the list of block types

## SirTrevorJs class

### Assets

For stylesheets :

    SirTrevorJs::stylesheets()

For scripts, in your Blade files :

    SirTrevorJs::scripts()

> version 0.3.0

### Fix for image block

Function to fix a problem with image block when you add a new image

    $text = SirTrevorJs::transformText($text);

## SirTrevorJsController

This class proposes two things :

* upload image where you want
* get tweets

### Upload image

This project proposes a system for upload image, nothing to configure, just the `directory_upload` value in config file.

    "directory_upload" => "img/uploads"

The uploader is in *SirTrevorJsController* class, and the project has a *route.php* file for it.

    Route::any("/sirtrevorjs/upload", array("uses" => "SirTrevorJsController@upload"));

### Tweet

This project proposes a system to get tweets. I use [twitter-l4](https://github.com/thujohn/twitter-l4) project.

The installation of twitter-l4 is done by Composer, but you need to configure it ( see [Instructions](https://github.com/thujohn/twitter-l4/blob/master/README.md)).

The tweet converter is in *SirTrevorJsController* class, and the project has a *route.php* file for it.

    Route::any("/sirtrevorjs/tweet", array("uses" => "SirTrevorJsController@tweet"));

## SirTrevorJsConverter class

Convert text from Sir Trevor Js to html :

    {{ SirTrevorJsConverter::toHtml($text) }}
    
Or via SirTrevorJS class :

    {{ SirTrevorJs::render($text) }}

For the moment, the code can convert :

* text
* list
* heading
* blockquote
* video (youtube, vimeo, dailymotion)
* image
* tweet