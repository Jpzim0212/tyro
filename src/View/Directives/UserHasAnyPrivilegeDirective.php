<?php

namespace HasinHayder\Tyro\View\Directives;

use Illuminate\Support\Facades\Blade;

class UserHasAnyPrivilegeDirective {
    /**
     * Register the @hasAnyPrivilege Blade directive.
     * Checks if the current user has any of the provided privileges.
     */
    public static function register(): void {
        Blade::if('hasAnyPrivilege', function (...$privileges) {
            $user = auth()->user();

            if (!$user || !method_exists($user, 'hasPrivilege')) {
                return false;
            }

            foreach ($privileges as $privilege) {
                if ($user->hasPrivilege($privilege)) {
                    return true;
                }
            }

            return false;
        });
    }
}
