<?php

namespace HasinHayder\Tyro\View\Directives;

use Illuminate\Support\Facades\Blade;

class UserHasPrivilegesDirective {
    /**
     * Register the @hasPrivileges Blade directive.
     * Checks if the current user has all of the provided privileges.
     */
    public static function register(): void {
        Blade::if('hasPrivileges', function (...$privileges) {
            $user = auth()->user();

            if (!$user || !method_exists($user, 'hasPrivileges')) {
                return false;
            }

            return $user->hasPrivileges($privileges);
        });
    }
}
