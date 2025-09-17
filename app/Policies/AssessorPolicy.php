<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Assessor;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssessorPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Assessor');
    }

    public function view(AuthUser $authUser, Assessor $assessor): bool
    {
        return $authUser->can('View:Assessor');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Assessor');
    }

    public function update(AuthUser $authUser, Assessor $assessor): bool
    {
        return $authUser->can('Update:Assessor');
    }

    public function delete(AuthUser $authUser, Assessor $assessor): bool
    {
        return $authUser->can('Delete:Assessor');
    }

    public function restore(AuthUser $authUser, Assessor $assessor): bool
    {
        return $authUser->can('Restore:Assessor');
    }

    public function forceDelete(AuthUser $authUser, Assessor $assessor): bool
    {
        return $authUser->can('ForceDelete:Assessor');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Assessor');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Assessor');
    }

    public function replicate(AuthUser $authUser, Assessor $assessor): bool
    {
        return $authUser->can('Replicate:Assessor');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Assessor');
    }

}