<?php 

namespace Wooletthedevsout\Payment;

use Nette\PhpGenerator\PhpFile as Builder;

class Generator
{
	public $classes;

	public $path = './gateways';

	public function __construct(array|null $classes)
	{
		if(is_file('./wc-config.yml') AND is_null($classes)) {

		} else {
			$this->classes = $classes;
		}

		if (!is_dir($this->path)) {
			mkdir($this->path, 0755, true);
		}
	}

	protected function create()
	{
		foreach ($classes as $class) {
			$classfile = str_replace("\\", '-', $class);
			$classfile = strtolower($classfile);

			$file = 'class-wc-' . $classfile . '.php';

			if(!is_file($this->path . '/' . $file)) {

				$code = $this->model($class);

				$controller = fopen($this->path . '/' . $file, 'w+');
				fwrite($controller, $classfile);
				fclose($controller);
			}
		}
	}

	protected function model(string $class)
	{
		$elements = explode("\\", $class);
		$elementsReversed = array_reverse($elements);
		$classname = $elementsReversed[0];
		$namespace = implode("\\", array_pop($elements));
	}

}