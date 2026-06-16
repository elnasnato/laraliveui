<?php

namespace Laraliveui\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'laraliveui:icon')]
class IconCommand extends Command
{
    protected $signature = 'laraliveui:icon {name} {--set=heroicons}';

    protected $description = 'Generate a LaraLiveUI icon component from Heroicons or other sets.';

    public function handle()
    {
        $name = $this->argument('name');
        $set = $this->option('set');

        $this->info("Icon [{$name}] from set [{$set}] - use <laraliveui:icon name=\"{$name}\" />");
    }
}
