<?php

namespace Modules\Roles\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsArray = [];
        $my_permissions = [
            'backups' => [
                'view-backups','create-backup','download-backup','delete-backup',
            ],
            'users' => [
                'view-users','create-user','edit-user','delete-user',
            ],
            'roles' => [
                'view-roles','create-role','edit-role','delete-role',
            ],
            'permissions' => [
                'view-permissions','create-permission','edit-permission','delete-permission',
            ],
            'settings' => ['view-settings'],
            'impersonate'=> ['impersonate-users', 'impersonate-clients', 'impersonate-employees'],
            'logs' => ['view-logs'],
            'calendar' => ['view-calendar'],
            'clients' => ['view-clients','create-client','edit-client','delete-client'],
            'projects' => ['view-projects','create-project','edit-project','delete-project'],
            'policies' => ['view-policies','create-policy','edit-policy','delete-policy'],
            'employees' => ['view-employees','create-employee','edit-employee','delete-employee'],
            'departments' => ['view-departments','create-department','edit-department','delete-department'],
            'designations' => ['view-designations','create-designation','edit-designation','delete-designation'],
            'holidays' => ['view-holidays','create-holiday','edit-holiday','delete-holiday'],
            'vacation Types' => ['view-vacationType','create-vacationType','edit-vacationType','delete-vacationType'],
            'vacations' => ['view-vacations','create-vacation','edit-vacation','delete-vacation'],
            'houses' => ['view-houses','create-house','edit-house','delete-house'],
            'agencies' => ['view-agencies','create-agency','edit-agency','delete-agency'],
            'timesheets' => ['view-timesheets','create-timesheet','edit-timesheet','delete-timesheet'],
            'shift' => ['view-shifts','create-shift','edit-shift','delete-shift'],
            'shiftSchedule' => ['view-shiftSchedules','create-shiftSchedule','edit-shiftSchedule','delete-shiftSchedule'],
            'overtime' => ['view-overtimes','create-overtime','edit-overtime','delete-overtime'],
            'goals' => ['view-goals','create-goal','edit-goal','delete-goal'],
            'goalTypes' => ['view-goalTypes','create-goalType','edit-goalType','delete-goalType'],
            'assets' => ['view-assets','create-asset','edit-asset','delete-asset'],
        ];

        foreach ($my_permissions as $module => $permissions) {
            foreach ($permissions as $permission) {
                $permissionsArray[] = [
                    "name" => $permission,
                    "module" => $module,
                    "guard_name" => "web"
                ];
            }
        }

        Permission::insert($permissionsArray);
        Role::create(
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Cordinator',
            ],
            [
                'name' => 'Employee',
            ],
            [
                'name' => 'HR',
            ]
        );
        $super_admin = Role::create(['name' => 'Super Admin']);
        $super_admin->givePermissionTo(Permission::all());
        $user = User::create([
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'username' => 'superadmin',
            'email' => 'super@admin.com',
            'phone' => '233542441933',
            'is_client' => false,
            'is_employee'=> false,
            'is_cordinator'=> false,
            'active'=> true,
            'password' => Hash::make('admin'),
            'gender' => 'male',
            'birthdate' => '2023-07-30',
            'address' => 'My address',
            'country' => 'Ghana',
            'state' => 'Accra',
            'zip_code' => '0233',
            'avatar' => null
        ]);
        $user->assignRole('Super Admin');
    }
}
