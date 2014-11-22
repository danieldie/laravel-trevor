Laravel4-SirTrevorJS
====================

Integrate the tool [Sir Trevor JS](http://madebymany.github.io/sir-trevor-js/) in a [Laravel](http://laravel.com) project.

## Installation

This package is available through `Packagist` and `Composer`.

Add `"caouecs/sirtrevorjs": "dev-master"` to your composer.json or run `composer require caouecs/sirtrevorjs`.
Then you have to add `"Caouecs\Sirtrevorjs\SirtrevorjsServiceProvider"` to your list of providers in your `app/config/app.php`, and a list of elements for aliases :

    'SirTrevorJs' => 'Caouecs\Sirtrevorjs\SirTrevorJs',
    'STConverter' => 'Caouecs\Sirtrevorjs\SirTrevorJsConverter'

So, I recommend you use [Package Installer](https://github.com/rtablada/package-installer), Laravel4-SirTrevorJS has a valid provides.json file. After installation of Package Installer, just run `php artisan package:install caouecs/sirtrevorjs` ; the lists of providers and aliases will be up-to-date.

Next, you must migrate config :

    php artisan config:publish caouecs/sirtrevorjs

### thujohn/twitter

To get tweets, this project uses [twitter-l4](https://github.com/thujohn/twitter-l4), so you must have a valid developer account of Twitter and add config file of twitter-l4 :

    php artisan config:publish thujohn/twitter

and add `"Thujohn\Twitter\TwitterServiceProvider"` to your list of providers in your `app/config/app.php`.

## Configuration file

After installation, the config file is located at *app/config/packages/caouecs/sirtrevorjs/sir-trevor-js.php*.

You can define :

* the path for image upload
* the path of Sir Trevor files
* the list of block types
* the language
* the paths for Eventable.js and Underscore.js
* configuration for blocks
    * soundcloud
    * gettyimages

## SirTrevorJs class

### Assets

For stylesheets :

    SirTrevorJs::stylesheets()

For scripts, in your Blade files :

    SirTrevorJs::scripts()

### Fix for image block

Function to fix a problem with image block when you add a new image

    $text = SirTrevorJs::transformText($text);

### Find first image

Get first image in text with `findImage` method :

    string SirTrevorJS::findImage(string $text);

In return, you have url of image or empty string.

### Find elements by blocktypes

Get all elements in text, in specified blocktype with `find` method :

    mixed SirTrevorJS::find(string $text, string $blocktype[, string $output = "json"])

In return, you can have :

* array, if you choose "array" for $output
* json, if you choose "json" for $output
* false, if the script doesn't find an occurence of blocktype

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

## SirTrevorJsConverter class (or STConverter class)

Convert text from Sir Trevor Js to html :

    $convert = new STConverter();
    $convert->toHtml($text)


Or via SirTrevorJS class :

    {{ SirTrevorJs::render($text) }}

For the moment, the code can convert :

* blockquote / quote
* embedly card
* [facebook post](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/facebook.js)
* [getty images](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/gettyimage.js)
* heading
* image
    * basic version
    * [version with caption](https://github.com/neyre/sir-trevor-wp/blob/master/custom-blocks/ImageCaption.js)
* [issuu](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/issuu.js)
* [pinterest](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/pinterest.js)
* [sketchlab](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/sketchlab.js)
* [slideshare](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/slideshare.js)
* [soundcloud](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/soundcloud.js)
* [spotify](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/spotify.js)
* text with Markdown
* tweet
* unordered list
* [video](https://github.com/caouecs/SirTrevorJS-blocks/blob/master/blocks/video.js)
    * aol
    * canal plus
    * daily mail uk
    * dailymotion
    * france tv
    * global news
    * livestream
    * metacafe
    * metatube
    * nbc bay area
    * nhl
    * ooyala
    * redtube
    * ustream (live and recorded)
    * veoh
    * vevo
    * vimeo
    * vine
    * wat
    * yahoo
    * youtube
    * zoomin.tv
    * video with caption
