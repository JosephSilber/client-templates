<?php namespace Silber\Templates;

use Symfony\Component\Finder\SplFileInfo;

class Template {

	/**
	 * The route to the template.
	 *
	 * @var string
	 */
	public $route;

	/**
	 * The absolute path to the template.
	 *
	 * @var string
	 */
	public $absolutePath;

	/**
	 * Whether to strip the extension for the ID attribute value.
	 *
	 * @var boolean
	 */
	protected $stripExtension;

	/**
	 * Create a new Template instance.
	 *
	 * @param  Symfony\Component\Finder\SplFileInfo  $file
	 * @param  string  $basePath
	 * @param  string  $relativePath
	 * @param  boolean  $stripExtension
	 */
	public function __construct(SplFileInfo $file, $basePath, $relativePath, $stripExtension = true)
	{
		$this->stripExtension = $stripExtension;

		$this->route = $this->route($file);

		$this->absolutePath = $basePath.'/'.$relativePath.'/'.$this->getRelativePath($file);;
	}

	/**
	 * Render a script tag for the template.
	 *
	 * @param  string  $type
	 * @return string
	 */
	public function renderScript($type)
	{
		$script = '<script type="'.$type.'" id="'.$this->route.'">';

		$script .= $this->render();

		$script .= '</script>';

		return $script;
	}

	/**
	 * Render the contents of the template file.
	 *
	 * @return string
	 */
	public function render()
	{
		ob_start();

		include($this->absolutePath);

		return ob_get_clean();
	}

	/**
	 * Get the route to a particular template.
	 *
	 * @param  Symfony\Component\Finder\SplFileInfo  $file
	 * @return string
	 */
	protected function route(SplFileInfo $file)
	{
		$route = $this->getRelativePath($file);

		if ($this->stripExtension)
		{
			$route = preg_replace('~\.[^\.]+$~', '', $route);
		}

		return $route;
	}

	/**
	 * Get the UNIX normalized relative path to a file.
	 *
	 * @param  Symfony\Component\Finder\SplFileInfo  $file
	 * @return string
	 */
	protected function getRelativePath(SplFileInfo $file)
	{
		return str_replace('\\', '/', $file->getRelativePathname());
	}

}
