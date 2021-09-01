<?php

return [
	'api_key' => env( 'GEOIP_KEY', '' ),
	'ip_lookup_cache_duration' => env( 'IP_LOOKUP_CACHE_DURATION', 60 * 60 * 24 ),
	'enabled' => env( 'GEOIP_ENABLED', true )
];
