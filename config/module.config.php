<?php

return array(
	'rdn_asset' => array(
		'adapter' => 'Symlink',
	),

	'rdn_asset_adapters' => array(
		'factories' => array(
			'Symlink' => 'RdnAsset\Factory\Adapter\Symlink',
		),

		'configs' => array(
			'Symlink' => array(
				'directory' => 'public/modules',
			),
		),
	),

	'rdn_console' => array(
		'commands' => array(
			'RdnAsset:Publish',
		),
	),

	'rdn_console_commands' => array(
		'factories' => array(
			'RdnAsset:Publish' => 'RdnAsset\Factory\Console\Command\Publish',
		),
	),

	'service_manager' => array(
		'factories' => array(
			'RdnAsset\Adapter\AdapterManager' => 'RdnAsset\Factory\Adapter\AdapterManager',
			'RdnAsset\Publisher' => 'RdnAsset\Factory\Publisher',
		),
	),
);
