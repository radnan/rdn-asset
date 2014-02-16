<?php

namespace RdnAsset;

use RdnAsset\Adapter\AdapterInterface;

class Publisher implements PublisherInterface
{
	/**
	 * @var AdapterInterface
	 */
	protected $adapter;

	public function __construct(AdapterInterface $adapter)
	{
		$this->setAdapter($adapter);
	}

	public function publish($source, $basename)
	{
		$this->adapter->publish($source, $basename);
	}

	public function prune()
	{
		$this->adapter->prune();
	}

	public function setAdapter(AdapterInterface $adapter)
	{
		$this->adapter = $adapter;
	}

	/**
	 * @return AdapterInterface
	 */
	public function getAdapter()
	{
		return $this->adapter;
	}
}
