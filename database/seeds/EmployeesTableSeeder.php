<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'full_name'      => 'Boss',
            'position'       => 'The Boss',
            'emp_start_date' => \Carbon\Carbon::now(),
            'salary'         => '100000',
            'boss_id'        => '-1',
        ]);
        for ($i = 1; $i <= 500; $i++) {
            DB::table('employees')->insert([
                'full_name'      => str_random(5) . ' ' . str_random(5),
                'position'       => 'HighSenior',
                'emp_start_date' => \Carbon\Carbon::now(),
                'salary'         => rand(10000, 90000),
                'boss_id'        => '1',
            ]);
        }
        for ($i = 1; $i <= 14500; $i++) {
            DB::table('employees')->insert([
                'full_name'      => str_random(5) . ' ' . str_random(5),
                'position'       => 'Senior',
                'emp_start_date' => \Carbon\Carbon::now(),
                'salary'         => rand(10000, 90000),
                'boss_id'        => rand(2, 500),
            ]);
        }
        for ($i = 1; $i <= 10000; $i++) {
            DB::table('employees')->insert([
                'full_name'      => str_random(5) . ' ' . str_random(5),
                'position'       => 'Middle',
                'emp_start_date' => \Carbon\Carbon::now(),
                'salary'         => rand(10000, 90000),
                'boss_id'        => rand(501, 15000),
            ]);
        }
        for ($i = 1; $i <= 10000; $i++) {
            DB::table('employees')->insert([
                'full_name'      => str_random(5) . ' ' . str_random(5),
                'position'       => 'Junior',
                'emp_start_date' => \Carbon\Carbon::now(),
                'salary'         => rand(10000, 90000),
                'boss_id'        => rand(15001, 25000),
            ]);
        }
        for ($i = 1; $i < 15000; $i++) {
            DB::table('employees')->insert([
                'full_name'      => str_random(5) . ' ' . str_random(5),
                'position'       => 'Trainee',
                'emp_start_date' => \Carbon\Carbon::now(),
                'salary'         => rand(10000, 90000),
                'boss_id'        => rand(25001, 35000),
            ]);
        }
    }
}
