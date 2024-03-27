<?php

namespace App\Interfaces;

interface PrepareData
{
	public function convStringToUtf8(string $string): string;
	public function setDataToJson(object $data): ?string;
	public function setDataToArray(object $data): ?array;
}
