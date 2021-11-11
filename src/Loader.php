<?php 

namespace Wooletthedevsout\Payment;

class Loader
{
	protected $classes;

	public $filepaths = [];

	public function __construct(array|string $classes)
	{
		$this->classes = $classes;

		$this->generate();

		add_filter('woocommerce_payment_gateways', [$this, 'gateways']);
		add_action('plugins_loaded', [$this, 'load']);
	}

	public function addFilePath(string $path)
	{
		$this->filepaths[] = $path;
	}

	protected function gateways($gateways)
	{
		foreach ($this->classes as $class) {
			$gateways[] = $class;
		}

		return $gateways;
	}

	protected function load()
	{
		foreach($this->filepath as $file) {
			require $file;
		}
	}
}