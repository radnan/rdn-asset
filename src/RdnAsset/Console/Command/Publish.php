<?php

namespace RdnAsset\Console\Command;

use RdnAsset\PublisherInterface;
use RdnConsole\Command\AbstractCommand;
use ReflectionClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zend\Filter\Word\CamelCaseToDash;
use Zend\ModuleManager\ModuleManager;

/**
 * Command line utility to publish module assets.
 */
class Publish extends AbstractCommand
{
	/**
	 * @var ModuleManager
	 */
	protected $modules;

	/**
	 * @var PublisherInterface
	 */
	protected $publisher;

	public function __construct(ModuleManager $modules, PublisherInterface $publisher)
	{
		$this->modules = $modules;
		$this->publisher = $publisher;
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		if ($input->getOption('prune'))
		{
			$output->writeln("<info>Cleaning up module assets</info>");
			$this->publisher->prune();
		}
		else
		{
			$this->doPublish($input, $output);
		}

	}

	/**
	 * Iterate over each module and publish its assets.
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 */
	protected function doPublish(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<info>Publishing module assets</info>');
		$nothing = true;

		$moduleName = $input->getOption('module');
		if ($moduleName)
		{
			$moduleNames = array($moduleName);
		}
		else
		{
			$moduleNames = $this->modules->getModules();
		}

		$inflector = new CamelCaseToDash;
		foreach ($moduleNames as $moduleName)
		{
			$source = $this->getPublicPath($moduleName);
			if ($source === false)
			{
				continue;
			}

			$output->writeln(" - <comment>{$moduleName}</comment>");

			$basename = strtolower($inflector->filter($moduleName));
			$this->publisher->publish($source, $basename);

			$nothing = false;
		}

		if ($nothing)
		{
			$output->writeln('Nothing to publish');
		}
	}

	/**
	 * Get the public path to the assets for a given module.
	 *
	 * We assume assets are stored in the <module-root>/public/ directory.
	 * If not, the module can implement the <code>getPublicPath()</code>
	 * method that returns the actual public path.
	 *
	 * @param string $moduleName
	 * @return bool|string
	 */
	protected function getPublicPath($moduleName)
	{
		$module = $this->modules->getModule($moduleName);
		if (method_exists($module, 'getPublicPath'))
		{
			$public = $module->getPublicPath();
		}
		elseif (method_exists($module, 'getRootPath'))
		{
			$public = $module->getRootPath() .'/public';
		}
		elseif (method_exists($module, 'getPath'))
		{
			$public = $module->getPath() .'/../../public';
		}
		else
		{
			$ref = new ReflectionClass($module);
			$path = dirname($ref->getFileName());
			$public = realpath($path .'/../../public');
		}

		if (is_dir($public))
		{
			return $public;
		}

		return false;
	}
}
