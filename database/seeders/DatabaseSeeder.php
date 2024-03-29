<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\Alternative;
use App\Models\Admin\ConditionReport;
use App\Models\Admin\Criteria;
use App\Models\Admin\Finance;
use App\Models\Admin\Job;
use App\Models\Admin\Picture;
use App\Models\Admin\Service;
use App\Models\Admin\SparePart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'phone_number' => '0811223344',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        User::factory(50)->create();

        // // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            'finance_create',
            'finance_edit',
            'finance_show',
            'finance_delete',
            'finance_access',
            'dashboard_access',
        ];
        // create permissions
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'description' => fake()->text(),
            ]);
        }
        // create roles and assign created permissions
        $roles = [
            'admin',
            'customer',
            'super-admin',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo([
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
        ]);

        $superAdmin = Role::where('name', 'super-admin')->first();
        $superAdmin->givePermissionTo(Permission::all());

        $superAdmin->givePermissionTo(Permission::all());

        // assign default user with role
        User::find(1)->assignRole('super-admin');
        User::find(2)->assignRole('admin');
        User::find(3)->assignRole('customer');

        $criteriaDatas = [
            [
                'name' => 'Durasi Pengerjaan',
                'weight' => 2,
                'unit' => 'Hari',
                'description' => 'Total estimasi pengerjaan unit hingga selesai',
                'type' => 0
            ],
            [
                'name' => 'Nilai Pengerjaan',
                'weight' => 4,
                'unit' => 'Juta Rupiah',
                'description' => 'Perkiraan keuntungan yang didapat untuk pengerjaan unit',
                'type' => 1
            ],
            [
                'name' => 'Tenaga Kerja yang Dibutuhkan',
                'weight' => 3,
                'unit' => 'Orang',
                'description' => 'Jumlah karyawan yang dibutuhkan untuk mengerjakan unit',
                'type' => 0
            ],
            [
                'name' => 'Jarak',
                'weight' => 1,
                'unit' => 'Kilometer',
                'description' => 'Jarak pengerjaan unit dari bengkel ',
                'type' => 0
            ],
            [
                'name' => 'Total Kedatangan',
                'weight' => 3,
                'unit' => 'Kali',
                'description' => 'Total kedatangan pelanggan dan unit dikerjakan',
                'type' => 1
            ]
        ];


        foreach ($criteriaDatas as $criteriaData) {
            Criteria::create($criteriaData);
        }
        // create alternative example
        for ($i = 1; $i < 6; $i++) {
            Alternative::create(['name' => 'Alternative ' . $i]);
        }

        $alternatives = Alternative::all();
        foreach ($alternatives as $alternative) {
            foreach (Criteria::all() as $criteria) {
                $alternative->criterias()->attach($criteria->id, ['value' => 1]);
            }
        }

        $status = ['To Do', 'Doing', 'Cancelled', 'Done'];
        $doings = [
            'Pembersihan unit',
            'Pengecetan',
            'Menunggu Spare Parts',
            'Siap diambil',
            'Menunggu Antrian',
            'Finishing',
        ];
        for ($i = 0; $i < 100; $i++) {
            Job::create([
                'name' => 'Job ' . $i,
                'serial_number' => 'KT008' . $i,
                'unit_kilometer' => rand(100, 10000),
                'date_in' => fake()->dateTimeBetween($startDate = '-7 months', $endDate = 'now'),
                'work_estimation' => rand(5, 30),
                'customer_name' => fake()->name(),
                'status' => collect($status)->random(),
                'doing' => collect($doings)->random(),
            ]);
        }

        // create job relation with services and spareparts
        foreach (Job::all() as $job) {
            Service::factory()->count(rand(1, 5))->state(['job_id' => $job->id])->create();
            SparePart::factory()->count(rand(1, 5))->state(['job_id' => $job->id])->create();
            ConditionReport::factory()->count(rand(1, 3))->state(['job_id' => $job->id])->create();
        }

        $conditionReports = ConditionReport::all();
        // foreach ($conditionReports as $conditionReport) {
        //     Picture::factory()->count(rand(1, 5))->state(['condition_report_id' => $conditionReport->id])->create();
        // }

        Finance::factory(50)->create();
    }
}
