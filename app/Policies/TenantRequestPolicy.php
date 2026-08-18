<?php

namespace App\Policies;

use App\Models\TenantRequest;
use App\Models\User;

class TenantRequestPolicy
{
    public function view(User $user, TenantRequest $tenantRequest): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->id === $tenantRequest->user_id;
    }

    public function download(User $user, TenantRequest $tenantRequest): bool
    {
        return $this->view($user, $tenantRequest);
    }

    public function update(User $user, TenantRequest $tenantRequest): bool
    {
        return $user->isAdmin();
    }
}
