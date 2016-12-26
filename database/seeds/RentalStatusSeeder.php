<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'  => trans('rental.lease-option'),
                'class' => 'label label-warning',
            ], 
            [
                'name'  => trans('rental.lease-confirm'),
                'class' => 'label label-success', 
            ], 
            [
                'name'  => trans('rental.lease-new'),
                'class' => 'label label-danger',
            ],
        ];

        $table = DB::table('rental_statuses'); 
        $table->delete(); 
        $table->insert($data);
    }
}
