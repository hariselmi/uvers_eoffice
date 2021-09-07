<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_permissions = [
            ['label'=>'List Scheduling Audit', 'name'=>'schedulingaudit.index'],

            ['label'=>'List Members', 'name'=>'members.index'],
            ['label'=>'Create Members', 'name'=>'members.create'],
            ['label'=>'Store Members', 'name'=>'members.store'],
            ['label'=>'View Members', 'name'=>'members.show'],
            ['label'=>'Delete Members', 'name'=>'members.destroy'],
            ['label'=>'Update Members', 'name'=>'members.update'],
            ['label'=>'Edit Members', 'name'=>'members.edit'],

            ['label'=>'List Schedules', 'name'=>'schedules.index'],
            ['label'=>'Create Schedules', 'name'=>'schedules.create'],
            ['label'=>'Store Schedules', 'name'=>'schedules.store'],
            ['label'=>'View Schedules', 'name'=>'schedules.show'],
            ['label'=>'Delete Schedules', 'name'=>'schedules.destroy'],
            ['label'=>'Update Schedules', 'name'=>'schedules.update'],
            ['label'=>'Edit Schedules', 'name'=>'schedules.edit'],

            ['label'=>'List Audit', 'name'=>'audit.index'],

            ['label'=>'List Documents', 'name'=>'documents.index'],
            ['label'=>'Create Documents', 'name'=>'documents.create'],
            ['label'=>'Store Documents', 'name'=>'documents.store'],
            ['label'=>'View Documents', 'name'=>'documents.show'],
            ['label'=>'Delete Documents', 'name'=>'documents.destroy'],
            ['label'=>'Update Documents', 'name'=>'documents.update'],
            ['label'=>'Edit Documents', 'name'=>'documents.edit'],
            ['label'=>'Print Documents', 'name'=>'documents.print'],

            ['label'=>'List Check Lists', 'name'=>'checklists.index'],
            ['label'=>'Create Check Lists', 'name'=>'checklists.create'],
            ['label'=>'Store Check Lists', 'name'=>'checklists.store'],
            ['label'=>'View Check Lists', 'name'=>'checklists.show'],
            ['label'=>'Delete Check Lists', 'name'=>'checklists.destroy'],
            ['label'=>'Update Check Lists', 'name'=>'checklists.update'],
            ['label'=>'Edit Check Lists', 'name'=>'checklists.edit'],
            ['label'=>'Print Check Lists', 'name'=>'checklists.print'],

            ['label'=>'List Findings', 'name'=>'findings.index'],
            ['label'=>'Create Findings', 'name'=>'findings.create'],
            ['label'=>'Store Findings', 'name'=>'findings.store'],
            ['label'=>'View Findings', 'name'=>'findings.show'],
            ['label'=>'Delete Findings', 'name'=>'findings.destroy'],
            ['label'=>'Update Findings', 'name'=>'findings.update'],
            ['label'=>'Edit Findings', 'name'=>'findings.edit'],
            ['label'=>'Print Findings', 'name'=>'findings.print'],

            ['label'=>'List Reports', 'name'=>'reports.index'],
            ['label'=>'Create Reports', 'name'=>'reports.create'],
            ['label'=>'Store Reports', 'name'=>'reports.store'],
            ['label'=>'View Reports', 'name'=>'reports.show'],
            ['label'=>'Delete Reports', 'name'=>'reports.destroy'],
            ['label'=>'Update Reports', 'name'=>'reports.update'],
            ['label'=>'Edit Reports', 'name'=>'reports.edit'],
            ['label'=>'Print Reports', 'name'=>'reports.print'],

            ['label'=>'List Upload Documents', 'name'=>'uploaddocuments.index'],
            ['label'=>'Create Upload Documents', 'name'=>'uploaddocuments.create'],
            ['label'=>'Store Upload Documents', 'name'=>'uploaddocuments.store'],
            ['label'=>'View Upload Documents', 'name'=>'uploaddocuments.show'],
            ['label'=>'Delete Upload Documents', 'name'=>'uploaddocuments.destroy'],
            ['label'=>'Update Upload Documents', 'name'=>'uploaddocuments.update'],
            ['label'=>'Edit Upload Documents', 'name'=>'uploaddocuments.edit'],

            ['label'=>'List Report All', 'name'=>'reportalls.index'],
            ['label'=>'Create Report All', 'name'=>'reportalls.create'],
            ['label'=>'Store Report All', 'name'=>'reportalls.store'],
            ['label'=>'View Report All', 'name'=>'reportalls.show'],
            ['label'=>'Delete Report All', 'name'=>'reportalls.destroy'],
            ['label'=>'Update Report All', 'name'=>'reportalls.update'],
            ['label'=>'Edit Report All', 'name'=>'reportalls.edit'],
            ['label'=>'Print Report All', 'name'=>'reportalls.print'],

            ['label'=>'List Data Master', 'name'=>'datamaster.index'],
            ['label'=>'Konfigurasi Website', 'name'=>'settingweb.index'],

            ['label'=>'List Standars', 'name'=>'standards.index'],
            ['label'=>'Create Standars', 'name'=>'standards.create'],
            ['label'=>'Store Standars', 'name'=>'standards.store'],
            ['label'=>'View Standars', 'name'=>'standards.show'],
            ['label'=>'Delete Standars', 'name'=>'standards.destroy'],
            ['label'=>'Update Standars', 'name'=>'standards.update'],
            ['label'=>'Edit Standars', 'name'=>'standards.edit'],

            ['label'=>'List Standar Details', 'name'=>'standarddetails.index'],
            ['label'=>'Create Standar Details', 'name'=>'standarddetails.create'],
            ['label'=>'Store Standar Details', 'name'=>'standarddetails.store'],
            ['label'=>'View Standar Details', 'name'=>'standarddetails.show'],
            ['label'=>'Delete Standar Details', 'name'=>'standarddetails.destroy'],
            ['label'=>'Update Standar Details', 'name'=>'standarddetails.update'],
            ['label'=>'Edit Standar Details', 'name'=>'standarddetails.edit'],


            ['label'=>'List Employees', 'name'=>'employees.index'],
            ['label'=>'Create Employees', 'name'=>'employees.create'],
            ['label'=>'Store Employees', 'name'=>'employees.store'],
            ['label'=>'View Employees', 'name'=>'employees.show'],
            ['label'=>'Delete Employees', 'name'=>'employees.destroy'],
            ['label'=>'Update Employees', 'name'=>'employees.update'],
            ['label'=>'Edit Employees', 'name'=>'employees.edit'],

            ['label'=>'List Articles', 'name'=>'articles.index'],
            ['label'=>'Create Articles', 'name'=>'articles.create'],
            ['label'=>'Store Articles', 'name'=>'articles.store'],
            ['label'=>'View Articles', 'name'=>'articles.show'],
            ['label'=>'Delete Articles', 'name'=>'articles.destroy'],
            ['label'=>'Update Articles', 'name'=>'articles.update'],
            ['label'=>'Edit Articles', 'name'=>'articles.edit'],

            ['label'=>'List Permissions', 'name'=>'permissions.list'],
            ['label'=>'Assaign Roles', 'name'=>'assaign.roles'],
            ['label'=>'Create Roles', 'name'=>'employeerole.create'],
            ['label'=>'Create Permission Role', 'name'=>'permissionrole.create'],
            ['label'=>'Create Permissions', 'name'=>'permissions.create'],
           // ['label'=>'Create Roles', 'name'=>'employeerole.create']

            ['label'=>'List Sliders', 'name'=>'sliders.index'],
            ['label'=>'Create Sliders', 'name'=>'sliders.create'],
            ['label'=>'Store Sliders', 'name'=>'sliders.store'],
            ['label'=>'View Sliders', 'name'=>'sliders.show'],
            ['label'=>'Delete Sliders', 'name'=>'sliders.destroy'],
            ['label'=>'Update Sliders', 'name'=>'sliders.update'],
            ['label'=>'Edit Sliders', 'name'=>'sliders.edit'],

            ['label'=>'List Pages', 'name'=>'pages.index'],
            ['label'=>'Create Pages', 'name'=>'pages.create'],
            ['label'=>'Store Pages', 'name'=>'pages.store'],
            ['label'=>'View Pages', 'name'=>'pages.show'],
            ['label'=>'Delete Pages', 'name'=>'pages.destroy'],
            ['label'=>'Update Pages', 'name'=>'pages.update'],
            ['label'=>'Edit Pages', 'name'=>'pages.edit'],

            ['label'=>'List Identitas', 'name'=>'identity.index'],
            ['label'=>'Create Identitas', 'name'=>'identity.create'],
            ['label'=>'Store Identitas', 'name'=>'identity.store'],
            ['label'=>'View Identitas', 'name'=>'identity.show'],
            ['label'=>'Delete Identitas', 'name'=>'identity.destroy'],
            ['label'=>'Update Identitas', 'name'=>'identity.update'],
            ['label'=>'Edit Identitas', 'name'=>'identity.edit'],

            ['label'=>'List Divisi', 'name'=>'division.index'],
            ['label'=>'Create Divisi', 'name'=>'division.create'],
            ['label'=>'Store Divisi', 'name'=>'division.store'],
            ['label'=>'View Divisi', 'name'=>'division.show'],
            ['label'=>'Delete Divisi', 'name'=>'division.destroy'],
            ['label'=>'Update Divisi', 'name'=>'division.update'],
            ['label'=>'Edit Divisi', 'name'=>'division.edit'],

            ['label'=>'List Periode', 'name'=>'period.index'],
            ['label'=>'Create Periode', 'name'=>'period.create'],
            ['label'=>'Store Periode', 'name'=>'period.store'],
            ['label'=>'View Periode', 'name'=>'period.show'],
            ['label'=>'Delete Periode', 'name'=>'period.destroy'],
            ['label'=>'Update Periode', 'name'=>'period.update'],
            ['label'=>'Edit Periode', 'name'=>'period.edit'],

            ['label'=>'List Berita Acara', 'name'=>'agenda.index'],
            ['label'=>'Create Berita Acara', 'name'=>'agenda.create'],
            ['label'=>'Store Berita Acara', 'name'=>'agenda.store'],
            ['label'=>'View Berita Acara', 'name'=>'agenda.show'],
            ['label'=>'Delete Berita Acara', 'name'=>'agenda.destroy'],
            ['label'=>'Update Berita Acara', 'name'=>'agenda.update'],
            ['label'=>'Edit Berita Acara', 'name'=>'agenda.edit'],

            ['label'=>'List Verikasi Tindak Lanjut', 'name'=>'verification.index'],
            ['label'=>'Create Verikasi Tindak Lanjut', 'name'=>'verification.create'],
            ['label'=>'Store Verikasi Tindak Lanjut', 'name'=>'verification.store'],
            ['label'=>'View Verikasi Tindak Lanjut', 'name'=>'verification.show'],
            ['label'=>'Delete Verikasi Tindak Lanjut', 'name'=>'verification.destroy'],
            ['label'=>'Update Verikasi Tindak Lanjut', 'name'=>'verification.update'],
            ['label'=>'Edit Verikasi Tindak Lanjut', 'name'=>'verification.edit'],

            ['label'=>'List RTM', 'name'=>'rtm.index'],
        ];
        $existing_permissions = Permission::pluck('name');
        foreach ($all_permissions as $value) {
            if (!in_array($value['name'], $existing_permissions->toArray())) {
                Permission::create([
                    'label'=>$value['label'],
                    'name'=>$value['name']
                ]);
            }
        }
        //$role = Role::where('name', 'admin')->first();
        if (! $role = Role::where('name', 'admin')->first()) {
            echo "creating Admin Role";
            $role = Role::create(['name' => 'admin']);
        }
        $user = User::where('email', 'admin@uvers.ac.id')->first();
        
        if (! $hasrole = $user->hasRole('admin')) {
            $user->assignRole('admin');
        }


        foreach ($all_permissions as $value) {
            if (! $permissionexist = $role->hasPermissionTo($value['name'])) {
                $role->givePermissionTo($value['name']);
            }
        }
    }
}
