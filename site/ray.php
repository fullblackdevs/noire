<?php
return [
    'enable' => true,
	'host' => (str_ends_with(getcwd(), 'app') || str_ends_with(getcwd(), 'web')) ? 'host.docker.internal' : 'localhost',
    'port' => 23517,
    'remote_path' => '/app',
    'local_path' => "/Users/miquelbrazil/Developer/fullblackdevs/noire/site",
];
