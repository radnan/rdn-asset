<?php

namespace RdnAsset\Factory\Adapter;

use RdnAsset\Adapter;
use RdnFactory\AbstractFactory;

class Symlink extends AbstractFactory
{
	protected function create()
	{
		$config = $this->config('rdn_asset_adapters', 'configs', 'Symlink');
		return new Adapter\Symlink($config['directory']);
	}
}
