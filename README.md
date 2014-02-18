RdnAsset
========

The **RdnAsset** ZF2 module provides a very simple way to publish the public assets for all your modules.

## How to install

1. Use `composer` to require the `radnan/rdn-asset` package:

   ~~~bash
   $ composer require radnan/rdn-asset:1.*
   ~~~

2. Activate the module by including it in your `application.config.php` file:

   ~~~php
   <?php

   return array(
       'modules' => array(
           'RdnAsset',
           // ...
       ),
   );
   ~~~

## How to use

Create a `public/` directory in your module's root and place all your public assets there. Then, simply run the following command from your project root:

~~~bash
$ vendor/bin/console asset:publish
~~~

This will publish the module's assets to your project root's `public/modules/` directory.

Now, you can include assets from this module by using the path `/modules/<module-name>/<asset-name>`. For example, in your view file you could do the following:

~~~php
<?php $this->headLink()
	->appendStylesheet($this->basePath('/modules/rdn-asset/css/foo.css')) ?>
~~~

## Asset source

By default, we assume assets are located in the `<module-root>/public/` directory. If this is not true for a module, you can implement the `getPublicPath()` method on it which should return the actual path to its assets:

~~~php
namespace App;

class Module
{
	public function getPublicPath()
	{
		return 'module/app/public-foo';
	}
}
~~~

## Publish path

Assets are published to the `<project-root>/public/modules/` directory. By default, the `Symlink` adapter is used to publish the assets. Assets are grouped by their module name and the module name is converted into `dash-case` to follow the standard asset naming conventions.

You can change this publish path by using the following configuration:

~~~php
<?php

return array(
	'rdn_asset' => array(
		'target_path' => 'public/modules-foo',
	),
);
~~~

## Asset cleanup

You can remove assets that no longer exist by using the `--prune` option:

~~~bash
$ vendor/bin/console asset:publish --prune
~~~
