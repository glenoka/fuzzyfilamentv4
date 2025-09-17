<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Formation_Selection;
use Illuminate\Auth\Access\HandlesAuthorization;

class Formation_SelectionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FormationSelection');
    }

    public function view(AuthUser $authUser, Formation_Selection $formationSelection): bool
    {
        return $authUser->can('View:FormationSelection');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FormationSelection');
    }

    public function update(AuthUser $authUser, Formation_Selection $formationSelection): bool
    {
        return $authUser->can('Update:FormationSelection');
    }

    public function delete(AuthUser $authUser, Formation_Selection $formationSelection): bool
    {
        return $authUser->can('Delete:FormationSelection');
    }

    public function restore(AuthUser $authUser, Formation_Selection $formationSelection): bool
    {
        return $authUser->can('Restore:FormationSelection');
    }

    public function forceDelete(AuthUser $authUser, Formation_Selection $formationSelection): bool
    {
        return $authUser->can('ForceDelete:FormationSelection');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FormationSelection');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FormationSelection');
    }

    public function replicate(AuthUser $authUser, Formation_Selection $formationSelection): bool
    {
        return $authUser->can('Replicate:FormationSelection');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FormationSelection');
    }

}