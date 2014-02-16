<?php

namespace RdnAsset\Adapter;

interface AdapterInterface
{
	public function publish($source, $basename);

	public function prune();
}
