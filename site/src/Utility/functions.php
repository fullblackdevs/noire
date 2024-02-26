<?php
function env(string $key, string|float|int|bool|null $default = null) : string|float|int|bool|null
{
	$key = strtoupper($key);

	if (isset($_ENV[$key])) {
		return $_ENV[$key];
	}

	return $default;
}

if (!function_exists('isCLI')) {
	function isCLI() : bool
	{
		return ((!empty(php_sapi_name()) && (stripos(php_sapi_name(), 'cli') !== false)) && (is_numeric($_SERVER['argc']) && $_SERVER['argc'] > 0));
	}
}
