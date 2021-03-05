<?php

namespace OtherApp\Livewire;

use Livewire\LivewireComponentsFinder as LivewireFinder;
use SplFileInfo;
use ReflectionClass;
use Livewire\Component;
use Illuminate\Support\Str;

class LivewireComponentsFinder extends LivewireFinder
{
    public function getClassNames()
    {
        return collect($this->files->allFiles($this->path))
            ->map(function (SplFileInfo $file) {
                return config('backstage-livewire.root_namespace') . '\\'.
                    Str::of($file->getPathname())
                        ->after(base_path(config('backstage-livewire.root_path')).'/')
                        ->replace(['/', '.php'], ['\\', ''])->__toString();
            })
            ->filter(function (string $class) {
                return is_subclass_of($class, Component::class) &&
                    ! (new ReflectionClass($class))->isAbstract();
            });
    }
}
