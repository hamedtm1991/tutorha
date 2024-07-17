<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Response as status;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Response::macro('ok', function ($message) {
            return response()->json([
                'status' => true,
                'message' => $message,
            ], status::HTTP_OK);
        });

        Response::macro('forbidden', function ($message = null) {
            return response()->json([
                'message' => $message ?? 'You don not have permission',
            ], status::HTTP_FORBIDDEN);
        });

        Response::macro('unauthorized', function ($message) {
            return response()->json([
                'status' => false,
                'message' => $message,
            ], status::HTTP_UNAUTHORIZED);
        });

        Response::macro('unprocessable', function ($message) {
            return response()->json([
                'status' => false,
                'message' => $message,
            ], status::HTTP_UNPROCESSABLE_ENTITY);
        });

        Response::macro('serverError', function ($message) {
            return response()->json([
                'status' => false,
                'message' => $message,
            ], status::HTTP_INTERNAL_SERVER_ERROR);
        });

        Builder::macro('search', function(string $attribute, string $searchTerm) {
            return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        });

        Collection::macro('paginate', function ($perPage = 15, $pageName = 'page', $page = null, $options = []) {

            // Resolve current page from request
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            // Paginate the Collection
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $this->count(),
                $perPage,
                $page,
                $options
            );

        });
    }
}
