<?php

return [
    'GALLERY_MODULE_URL' => env('DOCKER_GALLERY_MODULE_URL', env('GALLERY_MODULE_URL', '127.0.0.1:8002')),
    'EDITOR_MODULE_URL' => env('DOCKER_EDITOR_MODULE_URL', env('EDITOR_MODULE_URL', '127.0.0.1:8003')),
];