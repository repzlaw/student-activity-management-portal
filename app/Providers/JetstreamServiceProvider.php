<?php

namespace App\Providers;

use App\Actions\Jetstream\AddTeamMember;
use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\DeleteUser;
use App\Actions\Jetstream\InviteTeamMember;
use App\Actions\Jetstream\RemoveTeamMember;
use App\Actions\Jetstream\UpdateTeamName;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::createTeamsUsing(CreateTeam::class);
        Jetstream::updateTeamNamesUsing(UpdateTeamName::class);
        Jetstream::addTeamMembersUsing(AddTeamMember::class);
        Jetstream::inviteTeamMembersUsing(InviteTeamMember::class);
        Jetstream::removeTeamMembersUsing(RemoveTeamMember::class);
        Jetstream::deleteTeamsUsing(DeleteTeam::class);
        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the roles and permissions that are available within the application.
     */
    protected function configurePermissions(): void
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::role('admin', 'Administrator', [
            'team:create',
            'team:update',
            'team:invite',
            'team:assign',
            'team:dashboard',
            'activity:create',
            'activity:read',
            'activity:update',
            'activity:delete',
            'activity:review',
            'credential:create',
            'credential:read',
            'credential:update',
            'credential:delete',
            'credential:review',
            'event:create',
            'event:read',
            'event:update',
            'event:delete',
            
        ])->description('Administrator users can perform any action.');

        Jetstream::role('reviewer', 'Reviewer', [
            'team:dashboard',
            'activity:read',
            'activity:create',
            'activity:update',
            'activity:delete',
            'activity:import',
            'activity:export',
            'credential:create',
            'credential:read',
            'credential:update',
            'credential:delete',
            'event:create',
            'event:read',
            'event:update',
            'event:delete',
            
        ])->description('Reviewer users have the ability to read, create, and update data.');

        Jetstream::role('student', 'Student', [
            'activity:read',
            'activity:create',
            'activity:update',
            'credential:create',
            'credential:read',
            'credential:update',
            'credential:delete',
            'event:read',

        ])->description('Student users have the ability to read data.');
    }
}
