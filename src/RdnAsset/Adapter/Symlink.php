<?php

namespace RdnAsset\Adapter;

use RuntimeException;
use Zend\Stdlib\ErrorHandler;

/**
 * Publish assets using very simple symlinks.
 */
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
		$target = $this->directory .'/'. $basename;

		// Let's see if we can do a relative path
		if (strpos($source, getcwd()) === 0)
		{
			$source = str_repeat('../', count(explode('/', $target)) - 1) . substr($source, strlen(getcwd()) + 1);
		}

		if (file_exists($target))
		{
			if (!is_link($target) || readlink($target) == $source)
			{
				return;
			}

			unlink($target);
		}

		symlink($source, $target);
	}

	public function prune()
	{
		$filenames = scandir($this->directory);

		foreach ($filenames as $filename)
		{
			$filepath = $directory .'/'. $filename;
			$source = readlink($filepath);

			if (!file_exists($source))
			{
				unlink($filepath);
			}
		}
	}
}
