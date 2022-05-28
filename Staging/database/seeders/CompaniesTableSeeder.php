<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuperAdmin\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company1 = Company::create([
            'company_name' => 'Optiwatch Kenya Ltd', 
            'company_email' => 'info@optiwatchgroup.com',
        ]);
    }
}
