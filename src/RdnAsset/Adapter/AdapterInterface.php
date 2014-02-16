<?php

namespace RdnAsset\Adapter;

interface AdapterInterface
{
	/**
	 * Publish assets from the source directory to the target using the given basename.
	 *
	 * @param string $source
	 * @param string $basename
	 */
	public function publish($source, $basename);

	/**
	 * Prune the target of assets that no longer exist.
	 */
	public function prune();
}
