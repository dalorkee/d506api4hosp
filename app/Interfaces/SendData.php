<?php

namespace App\Interfaces;

interface SendData
{
	public function send506($id): null|array|string|object;
	public function send($data): ?string;
	public function send506MassAssign(array $data): ?bool;
}
