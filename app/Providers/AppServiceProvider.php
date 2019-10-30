<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add(
                [
                    'text' => 'Inspecciónes',
                    'icon'  => 'fas fa-clipboard-list',
                    'submenu'   => [
                        [
                            'text' => 'Lista de inspeciónes',
                            'url' => 'inspections/index',
                        ],
                        [
                            'text'  => 'Crear inspección',
                            'url'   => 'inspections/create'
                        ]
                    ]
                ],
                [
                    'text'  => 'Mantenimiento',
                    'icon'  => 'fas fa-tools',
                    'submenu'   => [
                        [
                            'text'  => 'Empresas',
                            'submenu'   => [
                                [
                                    'text'  => 'Crear empresa',
                                    'url'   => 'company/create'
                                ],
                                [
                                    'text'  => 'Lista de empresas',
                                    'url'   => 'company/index'
                                ]
                            ]
                        ],
                        [
                            'text'  => 'Productos',
                            'submenu'   => [
                                [
                                    'text'  => 'Crear producto',
                                    'url'   => 'product/create'
                                ],
                                [
                                    'text'  => 'Lista de productos',
                                    'url'   => 'product/index'
                                ]
                            ]
                        ]
                    ]
                ]
            );
        });
    }
}
