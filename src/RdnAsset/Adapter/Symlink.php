<?php

namespace RdnAsset\Adapter;

use RuntimeException;
use Zend\Stdlib\ErrorHandler;

class Symlink implements AdapterInterface
{
	protected $directory;

	public function __construct($directory)
	{
		$this->directory = rtrim($directory, '/');

		if (is_dir($directory) && !is_writable($directory))
		{
			throw new RuntimeException("Unable to write to the target directory ($directory)");
		}
		elseif (file_exists($directory) && !is_dir($directory))
		{
			throw new RuntimeException("Target must be a directory ($directory)");
		}

		if (!is_dir($directory))
		{
			ErrorHandler::start();
			mkdir(dirname($target), 0770, true);
			ErrorHandler::stop(true);
		}
	}

	public function publish($source, $basename)
	{
	}

	public function prune()
	{
	}
}
