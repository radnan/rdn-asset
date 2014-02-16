<?php

namespace RdnAsset\Factory;

use RdnAsset;
use RdnFactory\AbstractFactory;

class Publisher extends AbstractFactory
{
	protected function create()
	{
		$adapters = $this->service('RdnAsset\Adapter\AdapterManager');
		$adapter = $adapters->get($this->config('rdn_asset', 'adapter'));

		return new RdnAsset\Publisher($adapter);
	}
}
