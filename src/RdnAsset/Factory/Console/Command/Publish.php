<?php

namespace RdnAsset\Factory\Console\Command;

use RdnAsset\Console\Command;
use RdnConsole\Factory\Command\AbstractCommandFactory;
use Symfony\Component\Console\Input\InputOption;

class Publish extends AbstractCommandFactory
{
	public function configure()
	{
		$this->adapter
			->setName('asset:publish')
			->setDescription('Publish assets from all modules to the <comment>public/</comment> directory')
			->addOption(
				'module',
				null,
				InputOption::VALUE_REQUIRED,
				'Only publish the assets for the given module.'
			)
			->addOption(
				'prune',
				null,
				InputOption::VALUE_NONE,
				'Remove assets that no longer exist.'
			)
		;
	}

	protected function create()
	{
		$modules = $this->service('ModuleManager');
		$publisher = $this->service('RdnAsset\Publisher');

		return new Command\Publish($modules, $publisher);
	}
}
