<?php

namespace RdnAsset\Factory;

use RdnAsset;
use RdnFactory\AbstractFactory;

class Publisher extends AbstractFactory
{
	protected function create()
	{
		return new RdnAsset\Publisher;
	}
}
