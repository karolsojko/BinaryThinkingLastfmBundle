BinaryThinking/LastfmBundle
==========================

[![Build Status](https://secure.travis-ci.org/karolsojko/BinaryThinkingLastfmBundle.png)](http://travis-ci.org/karolsojko/BinaryThinkingLastfmBundle)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/karolsojko/BinaryThinkingLastfmBundle/badges/quality-score.png?s=f63ad0acdbdcd1687e9b1db68ae53404f1116617)](https://scrutinizer-ci.com/g/karolsojko/BinaryThinkingLastfmBundle/)

Symfony 2 Bundle for Last.fm API

This is a Bundle that will help you communicate with Last.fm's API. 

Status
======

The Bundle handles now only API methods for following contexts (Please see [Milestones](https://github.com/karolsojko/BinaryThinkingLastfmBundle/issues/milestones) on github):
- Album
- Artist
- Tag

Stay tunned for more comming soon.

Installation
============

If you're using composer just add:

```json
{
    "require": {
        "binarythinking/lastfm-bundle": "*"
    }
}
```

If you're using a deps file just add:

```
[BinaryThinkingLastfmBundle]
    target=/bundles/BinaryThinking/LastfmBundle
    git=http://github.com/karolsojko/BinaryThinkingLastfmBundle.git
```

Register the BinaryThinking namespace in autoload.php

```php
<?php
$loader->registerNamespaces(array(
    // ...
    'BinaryThinking'  => __DIR__ . '/../vendor/bundles',
    ...
));
```

And the bundle to AppKernel.php

```php
<?php
$bundles = array(
  // ...
  new BinaryThinking\LastfmBundle\BinaryThinkingLastfmBundle()
);
```

Configuration
=============

After installing just configure your application with your Last.fm API key and secret.

In your config define those two as:

```yaml
binary_thinking_lastfm:
  client_apikey: "my_api_key"
  client_secret: "my_secret"
```

Using
=====

In your controller if you want for example a client for the album API context just get the service like this:

```php
<?php
$albumClient = $this->get('binary_thinking_lastfm.client.album');
```

Or you can get the client factory and request for a specific client f.e. album:

```php
<?php
$clientFactory = $this->get('binary_thinking_lastfm.client_factory');
$albumClient = $clientFactory->getClient('album', $apiKey, $apiSecret);
```

Once you have your client you can use on it the methods that are available in the [Last.fm API](http://www.lastfm.pl/api/intro) f.e.

```php
<?php
// search for an album
$albums = $albumClient->search('Sound of perseverance');

// get detailed info on an album
$album = $albumClient->getInfo('Cynic', 'Focus');
```

