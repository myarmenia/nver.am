<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap for the website';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency('daily')->setLastModificationDate(now()))
            ->add(Url::create('/about')->setPriority(0.8)->setChangeFrequency('monthly')->setLastModificationDate(now()));

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Карта сайта успешно сгенерирована.');
    }
}
