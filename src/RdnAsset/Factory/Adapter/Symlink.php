<?php

namespace RdnAsset\Factory\Adapter;

use RdnAsset\Adapter;
use RdnFactory\AbstractFactory;

class Symlink extends AbstractFactory
{
	protected function create()
	{
		$directory = $this->config('rdn_asset', 'target_path');
		return new Adapter\Symlink($directory);
	}
}
