<?php namespace Silber\Templates;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Templates {

	/**
	 * The absolute path to the views directory.
	 *
	 * @var string
	 */
	protected $views;

	/**
	 * The configuration options.
	 *
	 * @var array
	 */
	protected $config;

	/**
	 * Create a new Templates instance.
	 *
	 * @param string  $views
	 */
	public function __construct($views, array $config = [])
	{
		$this->config = $config;
		$this->views = $views;
	}

	/**
	 * Render the templates at a given path.
	 *
	 * @param  string  $path
	 * @return string
	 */
	public function render($path)
	{
		$type = $this->getType();

		$result = '';

		foreach ($this->find($path) as $template)
		{
			$result .= $template->renderScript($type);
		}

		return $result;
	}

	/**
	 * Find templates within a given relative directory.
	 *
	 * @param  string  $path
	 * @return array
	 */
	public function find($path)
	{
		$files = [];

		foreach ($this->getFinder($path) as $file)
		{
			$files[] = $this->getTemplate($file, $path);
		}

		return $files;
	}

	/**
	 * Get a file's template.
	 *
	 * @param  Symfony\Component\Finder\SplFileInfo  $file
	 * @param  string  $path
	 * @return Auction\Templates\Template
	 */
	protected function getTemplate(SplFileInfo $file, $path)
	{
		$strip = ! empty($this->config['strip']);

		return new Template($file, $this->views, $path, $strip);
	}

	/**
	 * Get a new finder instance for a given path.
	 *
	 * @param  string  $path
	 * @return Symfony\Component\Finder\Finder
	 */
	protected function getFinder($path)
	{
		$finder = $this->newFinder();

		$finder->files()->name('*.php')->name('*.html');

		if ( ! empty($this->config['exclude']))
		{
			$finder->notPath($this->config['exclude']);
		}

		return $finder->in($this->path($path));
	}

	/**
	 * Get the path to the templates directory.
	 *
	 * @param  string  $path
	 * @return string
	 */
	protected function path($path)
	{
		return $this->views.DIRECTORY_SEPARATOR.$path;
	}

	/**
	 * Get the value for the "type" attribute.
	 *
	 * @return string
	 */
	protected function getType()
	{
		return isset($this->config['type']) ? $this->config['type'] : '';
	}

	/**
	 *  Get a new Finder instance.
	 *
	 * @return Symfony\Component\Finder\Finder
	 */
	protected function newFinder()
	{
		return new Finder;
	}

}
