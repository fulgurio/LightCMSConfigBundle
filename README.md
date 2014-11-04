LightCMSConfigBundle
====================

LightCMSConfig is a plugin for LightCMSConfig to manage some parameters for your
website.

Installation
------------

Installation is not so hard

1. Download FulgurioLightCMSConfigBundle using composer
2. Enable the Bundle
3. Import routing
4. Add some parameters with command line
5. What to do

That's easy !

### Step 1: Download FulgurioLightCMSConfigBundle

First, edit composer.json, and add the bundle

``` yaml
{
    "require": {
        "fulgurio/light-cms-config-bundle" : "dev-master"
    }
}```

After, just launch composer, it will load all dependencies

``` bash
$ ./composer update
```

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Fulgurio\LightCMSBundle\FulgurioLightCMSConfigBundle(),
    );
}
```

### Step 3: Import routing file

Now that you have activated and configured the bundle, all that is left to do is
 import the FulgurioLightCMSConfigBundle routing file.

Important : don't put these lines after the FulgurioLightCMSBundle lines.

``` yaml
FulgurioLightCMSConfigBundle:
    resource: "@FulgurioLightCMSConfigBundle/Resources/config/routing.yml"
    prefix:   /
```

### Step 4: Add some parameters with command line

You can take a look to the admin interface (/admin/configuration), there's no
data. This bundle does'nt allow creation of parameters, you can only edit them
with the administration interface.

To add some parameters, you need to use command line

``` bash
$ ./bin/console config:add typeOfParameters parameterName parameterValue
```
You can also edit and remove with commande line.

Actually only file, image and text (default) are available.

### Step 5: What to do
Well, ok, you can add some informations for your website, but how it works ?

Take a look at this example : we will manage the background of the website.
First, I need to choose the name of my parameter.
fulgurio.website.background looks good

So with command line, types :
``` bash
$ ./bin/console config:add image fulgurio.website.background change
```
I put "change" for the value, because you need one

Now, I have fulgurio.website.background on my configuration manager. Ok, that's
working, but it's not userfriendly.
Just add to your translate resource the name of your parameter.

Add or create the file app/Resources/translations/admin.en.yml
``` yaml
fulgurio:
    website:
        background: Background
```
Refresh the cache, well, it's better

Now, select a picture to put on your background, you'll see a thumbnail. Save,
that's it !

Ok, it's wonderfull, now, we need to add the background on our website. Just
edit the template file (like base.html.twig), add a <style> tag and call the
getConfig function with your parameter (fulgurio.website.background)
You get something like that :

``` twig
	<style>
		body {
			background-image: url({{ getConfig('fulgurio.website.background') }});
		}
	</style>
```

Well done, Kalagan !