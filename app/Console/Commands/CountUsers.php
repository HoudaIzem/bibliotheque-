<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CountUsers extends Command
{
    protected $signature = 'users:count';
    protected $description = 'Affiche le nombre total d\'utilisateurs';

    public function handle()
    {
        $count = User::count();
        $this->info("Nombre total d'utilisateurs : {$count}");
    }
}
