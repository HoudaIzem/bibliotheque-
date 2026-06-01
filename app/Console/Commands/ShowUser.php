<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowUser extends Command
{
    protected $signature = 'users:show {id} {--field=name}';

    protected $description = 'Command description';

    public function handle()
    {
        //
    }
}
