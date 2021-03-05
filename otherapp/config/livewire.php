<?php

return [
    'class_namespace' => 'OtherApp\Http\Livewire',
    'view_path' => base_path('otherapp/resources/views/livewire'),
    'middleware_group' => 'web',
    'manifest_path' => app()->bootstrapPath('cache/livewire-otherapp-components.php'),
    'components_path' => base_path('otherapp/Http/Livewire'),
    'prefix' => 'otherapp',
    'root_namespace' => 'OtherApp',
    'root_path' => 'otherapp',
];
