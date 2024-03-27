<?php

namespace App\Exceptions;

use Illuminate\Http\{Request,Response};
use App\Exceptions\Error;
use Exception;

abstract class ApplicationException extends Exception
{
	abstract public function status(): int;
	abstract public function help(): string;
	abstract public function error(): string;

	public function render(Request $request): Response {
		$error = new Error($this->help(), $this->error());
		return response($error->toArray(), $this->status());
	}
}
