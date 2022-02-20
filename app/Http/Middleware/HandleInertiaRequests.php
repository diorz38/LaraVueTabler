<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Application;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $metadata = json_decode(file_get_contents(base_path('package-lock.json')));
        $metaKeys = collect($metadata->dependencies);
    
        $appInfo = [
            'phpVersion' => 'PHP v'.PHP_VERSION,
            'laravelVersion' => 'Laravel v'.Application::VERSION,
            'vueVersion' => 'Vue v'.$metaKeys["vue"]->version,
            'inertiaVersion' => 'Inertiajs v'.$metaKeys["@inertiajs/inertia"]->version,
            'tablerVersion' => 'Tabler v'.$metaKeys["@tabler/core"]->version
        ];
        
        return array_merge(parent::share($request), [
            'appInfo' => $appInfo,
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'auth' => Auth::user() ? [
                'user' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'avatar' => 'https://i.pravatar.cc/150?u='.Auth::user()->email,
                    'permissions' => ['create.user','update.user'],
                ]
            ] : null
        ]);
    }
}
