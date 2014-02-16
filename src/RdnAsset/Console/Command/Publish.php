<?php

namespace RdnAsset\Console\Command;

use RdnAsset\PublisherInterface;
use RdnConsole\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\ModuleManager\ModuleManager;

/**
 * Command line utility to publish module assets.
 */
class Publish extends AbstractCommand
{
	protected $modules;

	protected $publisher;

	public function __construct(ModuleManager $modules, PublisherInterface $publisher)
	{
		$this->modules = $modules;
		$this->publisher = $publisher;
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
	}
}
