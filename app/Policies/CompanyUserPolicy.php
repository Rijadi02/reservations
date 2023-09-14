<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use App\Enums\Role;

class CompanyUserPolicy
{

    public function before(User $user): bool|null
    {
        //Kjo e lejon userin me hi ku don, perderisa eshte admin
        if ($user->role_id === Role::ADMINISTRATOR->value) {
            return true;
        }

        return null;
    }

    public function viewAny(User $user, Company $company): bool
    {
        //Nese roli i Userit eshte admin edhe eshte comapny_id eshte e qesaj kompanis
        //Kjo e bon return true
        return $user->role_id === Role::COMPANY_OWNER->value && $user->company_id === $company->id;
    }

    public function create(User $user, Company $company): bool
    {
        return $user->role_id === Role::COMPANY_OWNER->value && $user->company_id === $company->id;
    }

    public function update(User $user, Company $company): bool
    {
        return $user->role_id === Role::COMPANY_OWNER->value && $user->company_id === $company->id;
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->role_id === Role::COMPANY_OWNER->value && $user->company_id === $company->id;
    }
}
