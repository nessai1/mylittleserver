<?php

namespace Core\Page;

use Core\Rest\Handler\RestHandler;
use Core\View\View;
use Core\View\ViewInterface;

/**
 * Class SinglePageApplication is a page that renders a view for get requests and handles rest requests on the same page
 */
class SinglePageApplication implements Page
{
	protected RestHandler|null $restHandler;
	protected ViewInterface $view;

	public function __construct(ViewInterface $view, RestHandler $handler = null)
	{
		$this->restHandler = $handler;
		$this->view = $view;
	}

	/**
	 * Listen to the request and return the response
	 *
	 * @return void
	 */
	public function run(): void
	{
		if ($this->getMethod() === 'GET')
		{
			echo $this->view->getContent();
		}
		else if ($this->restHandler !== null && $this->getContentTypes() === 'application/json')
		{
			$this->restHandler->listen();
		}
	}

	/**
	 * Get the request method
	 *
	 * @return string
	 */
	protected function getMethod(): string
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * Get the request content type
	 *
	 * @return string
	 */
	protected function getContentTypes(): string
	{
		if ($this->getMethod() !== 'POST') // Contect-type accessible only for POST requests
		{
			return '';
		}

		return $_SERVER['CONTENT_TYPE'];
	}
}