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
				'The module to use for this command.'
			)
			->addOption(
				'prune',
				null,
				InputOption::VALUE_NONE,
				'Remove items from the destination directory that no longer exist.'
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
