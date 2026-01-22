<?php

namespace InfoEsportes\FilamentDuprSocialLogin\Commands;

use Illuminate\Console\Command;

class FilamentDuprSocialLoginCommand extends Command
{
    public $signature = 'filament-dupr-social-login';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
