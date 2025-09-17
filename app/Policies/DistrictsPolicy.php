<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Districts;
use Illuminate\Auth\Access\HandlesAuthorization;

class DistrictsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Districts');
    }

    public function view(AuthUser $authUser, Districts $districts): bool
    {
        return $authUser->can('View:Districts');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Districts');
    }

    public function update(AuthUser $authUser, Districts $districts): bool
    {
        return $authUser->can('Update:Districts');
    }

    public function delete(AuthUser $authUser, Districts $districts): bool
    {
        return $authUser->can('Delete:Districts');
    }

    public function restore(AuthUser $authUser, Districts $districts): bool
    {
        return $authUser->can('Restore:Districts');
    }

    public function forceDelete(AuthUser $authUser, Districts $districts): bool
    {
        return $authUser->can('ForceDelete:Districts');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Districts');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Districts');
    }

    public function replicate(AuthUser $authUser, Districts $districts): bool
    {
        return $authUser->can('Replicate:Districts');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Districts');
    }

}