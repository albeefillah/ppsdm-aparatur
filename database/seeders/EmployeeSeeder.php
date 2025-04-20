<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['name' => 'AHMAD SULAEMAN JAJULI', 'category' => 'cs', 'team' => 1],
            ['name' => 'AGUNG MUTARAM', 'category' => 'cs', 'team' => 1],
            ['name' => 'SUMARNA', 'category' => 'cs', 'team' => 1],
            ['name' => 'AHMAD ROYANI', 'category' => 'cs', 'team' => 1],
            ['name' => 'ERWIN YULI PRATAMA', 'category' => 'cs', 'team' => 1],
            ['name' => 'ENDRI MAHENDRA', 'category' => 'cs', 'team' => 1],
            ['name' => 'YAYAT BAHRUL HAYAT', 'category' => 'cs', 'team' => 1],
            ['name' => 'JAJANG SUPRIATNA', 'category' => 'cs', 'team' => 1],
            ['name' => 'IMAN NAFIAN', 'category' => 'cs', 'team' => 1],
            ['name' => 'ARYA SOMADI SOMAD', 'category' => 'cs', 'team' => 1],
            ['name' => 'DEDE RAHMAT', 'category' => 'cs', 'team' => 1],
            ['name' => 'ANDI YAWAN', 'category' => 'cs', 'team' => 1],
            ['name' => 'SUNARDI MUHAMAD', 'category' => 'garden', 'team' => 2],
            ['name' => 'ADE RONI DARUSMAN', 'category' => 'marbot', 'team' => 2],
            ['name' => 'IWAN WIRATMAJA', 'category' => 'cs', 'team' => 2],
            ['name' => 'GANDI SUMARNA', 'category' => 'garden', 'team' => 2],
            ['name' => 'SAEFUL ULUM', 'category' => 'marbot', 'team' => 2],
            ['name' => 'ERY JUMAERY LUTHER', 'category' => 'cs', 'team' => 2],
            ['name' => 'HARDIYANA', 'category' => 'cs', 'team' => 3],
            ['name' => 'WIWIN WINARSIH', 'category' => 'women', 'team' => 3],
            ['name' => 'DIANA', 'category' => 'cs', 'team' => 3],
            ['name' => 'INDRA SAPUTRA', 'category' => 'cs', 'team' => 3],
            ['name' => 'MARSYA NUR HERLIANA PUTRI', 'category' => 'women', 'team' => 3],
            ['name' => 'HARDIAN LESMANA', 'category' => 'cs', 'team' => 3],
            ['name' => 'TATAG FADJARYUDHI', 'category' => 'koor', 'team' => 4],
        ];
        // $employees = [
        //     ['name' => 'AHMAD SULAEMAN JAJULI', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'AGUNG MUTARAM', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'SUMARNA', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'AHMAD ROYANI', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'ERWIN YULI PRATAMA', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'ENDRI MAHENDRA', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'YAYAT BAHRUL HAYAT', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'JAJANG SUPRIATNA', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'IMAN NAFIAN', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'ARYA SOMADI SOMAD', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'DEDE RAHMAT', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'ANDI YAWAN', 'category' => 'cs', 'team' => 1],
        //     ['name' => 'SUNARDI MUHAMAD', 'category' => 'garden', 'team' => 2],
        //     ['name' => 'ADE RONI DARUSMAN', 'category' => 'marbot', 'team' => 2],
        //     ['name' => 'TATAG FADJARYUDHI', 'category' => 'banquet', 'team' => 2],
        //     ['name' => 'GANDI SUMARNA', 'category' => 'garden', 'team' => 2],
        //     ['name' => 'SAEFUL ULUM', 'category' => 'marbot', 'team' => 2],
        //     ['name' => 'ERY JUMAERY LUTHER', 'category' => 'cs', 'team' => 2],
        //     ['name' => 'HARDIYANA', 'category' => 'cs', 'team' => 3],
        //     ['name' => 'WIWIN WINARSIH', 'category' => 'women', 'team' => 3],
        //     ['name' => 'DIANA', 'category' => 'cs', 'team' => 3],
        //     ['name' => 'INDRA SAPUTRA', 'category' => 'cs', 'team' => 3],
        //     ['name' => 'MARSYA NUR HERLIANA PUTRI', 'category' => 'women', 'team' => 3],
        //     ['name' => 'HARDIAN LESMANA', 'category' => 'banquet', 'team' => 3],
        //     ['name' => 'IWAN WIRATMAJA', 'category' => 'koor', 'team' => 4],
        // ];

        foreach ($employees as $emp) {
            Employee::create($emp);
        }
    }
}
