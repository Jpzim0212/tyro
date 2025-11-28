<?php

namespace HasinHayder\Tyro\View\Directives;

use Illuminate\Support\Facades\Blade;

class UserCanDirective {
    /**
     * Register the @userCan Blade directive.
     * Checks if the current user has a specific role or privilege.
     */
    public static function register(): void {
        Blade::if('userCan', function (string $ability) {
            $user = auth()->user();

            if (!$user) {
                return false;
            }

            // Check if user has the ability (role or privilege)
            return method_exists($user, 'can') ? $user->can($ability) : false;
        });
    }
}
