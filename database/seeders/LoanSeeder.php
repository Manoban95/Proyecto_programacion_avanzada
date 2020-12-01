<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;


class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan = new Loan();
        $loan->book_id = 2;
        $loan->user_id = 2;
        $loan->Fecha_prestamo = "2019-03-12";
        $loan->Fecha_devolucion = "2019-03-15";
        $loan->Estatus = "Pendiente";
        $loan->save();

        $loan = new Loan();
        $loan->book_id = 2;
        $loan->user_id = 2;
        $loan->Fecha_prestamo = "2019-04-12";
        $loan->Fecha_devolucion = "2019-04-15";
        $loan->Estatus = "pendiente";
        $loan->save();

        $loan = new Loan();
        $loan->book_id = 1;
        $loan->user_id = 1;
        $loan->Fecha_prestamo = "2019-03-12";
        $loan->Fecha_devolucion = "2019-03-15";
        $loan->Estatus = "pendiente";
        $loan->save();

        $loan = new Loan();
        $loan->book_id = 1;
        $loan->user_id = 1;
        $loan->Fecha_prestamo = "2019-06-12";
        $loan->Fecha_devolucion = "2019-06-15";
        $loan->Estatus = "pendiente";
        $loan->save();



        
        


       


        


       


    }
}
