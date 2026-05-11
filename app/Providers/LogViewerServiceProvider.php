<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\LogFile;
use Opcodes\LogViewer\LogFolder;

class LogViewerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('viewLogViewer', function ($user) {
            return $user->can('log-viewer.access');
        });

        Gate::define('downloadLogFile', function ($user, LogFile $file) {
            return $user->can('log-viewer.download');
        });

        Gate::define('downloadLogFolder', function ($user, LogFolder $folder) {
            return $user->can('log-viewer.download');
        });

        Gate::define('deleteLogFile', function ($user, LogFile $file) {
            return $user->can('log-viewer.delete');
        });

        Gate::define('deleteLogFolder', function ($user, LogFolder $folder) {
            return $user->can('log-viewer.delete');
        });
    }
}
