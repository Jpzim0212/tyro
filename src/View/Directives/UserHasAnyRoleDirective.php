<?php

namespace HasinHayder\Tyro\View\Directives;

use Illuminate\Support\Facades\Blade;

class UserHasAnyRoleDirective {
    /**
     * Register the @hasAnyRole Blade directive.
     * Checks if the current user has any of the provided roles.
     */
    public static function register(): void {
        Blade::if('hasAnyRole', function (...$roles) {
            $user = auth()->user();

            if (!$user || !method_exists($user, 'hasRole')) {
                return false;
            }

            foreach ($roles as $role) {
                if ($user->hasRole($role)) {
                    return true;
                }
            }

            return false;
        });
    }
}
