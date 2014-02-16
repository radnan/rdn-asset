<?php

namespace RdnAsset;

interface PublisherInterface
{
	public function publish($source, $basename);

	public function prune();
}
