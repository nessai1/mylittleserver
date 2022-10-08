<?php

namespace Core\Rest\Response;

final class Response implements \Stringable
{
	protected ResponseType $responseType;
	protected array $data = [];

	public function __construct(ResponseType $responseType, array $data = [])
	{
		$this->responseType = $responseType;
		$this->data = $data;
	}

	public function __toString(): string
	{
		return json_encode([
			'code' => $this->responseType->name,
			'data' => $this->data,
		]);
	}
}