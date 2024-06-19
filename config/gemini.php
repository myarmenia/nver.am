<?php

return [
    'base_url' => env('GEMINI_BASE_URL', 'https://api.gemini.com'),
    'api_key' => env('GEMINI_API_KEY', ''),
    'request_timeout' => env('GEMINI_REQUEST_TIMEOUT', 30),
];