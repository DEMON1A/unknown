<?php namespace Anomaly\AddonsModule;

use Anomaly\AddonsModule\Addon\AddonRepository;
use Anomaly\AddonsModule\Addon\Contract\AddonRepositoryInterface;
use Anomaly\AddonsModule\Composer\ComposerAuthorizer;
use Anomaly\AddonsModule\Console\Download;
use Anomaly\AddonsModule\Console\Remove;
use Anomaly\AddonsModule\Console\Show;
use Anomaly\AddonsModule\Console\Sync;
use Anomaly\AddonsModule\Console\Update;
use Anomaly\AddonsModule\Listener\RefreshAddonsModule;
use Anomaly\AddonsModule\Repository\Contract\RepositoryRepositoryInterface;
use Anomaly\AddonsModule\Repository\RepositoryRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;

/**
 * Class AddonsModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        Show::class,
        Sync::class,
        Remove::class,
        Update::class,
        Download::class,
    ];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        AddonsModulePlugin::class,
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        SystemIsRefreshing::class => [
            RefreshAddonsModule::class,
        ],
    ];

    /**
     * The addon singletons.
     *
     * @var array
     */
    protected $singletons = [
        AddonRepositoryInterface::class      => AddonRepository::class,
        ComposerAuthorizer::class            => ComposerAuthorizer::class,
        RepositoryRepositoryInterface::class => RepositoryRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/demonia/unknown'    => [
            'as'   => 'demonia.demonia.unknown',
            'uses' => 'Anomaly\AddonsModule\Http\Controller\Admin\AddonsController@unknown',
        ],
    ];

}
