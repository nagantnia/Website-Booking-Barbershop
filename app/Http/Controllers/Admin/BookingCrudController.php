<?php

namespace App\Http\Controllers\Admin;

use App\Models\Booking;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookingCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Booking::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/booking');
        CRUD::setEntityNameStrings('booking', 'bookings');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('full_name')->label('Customer Name');
        CRUD::column('phone_number');
        CRUD::column('barber_id')->type('select')
            ->entity('barber')
            ->attribute('barber_name')
            ->label('Barber');
        CRUD::column('booking_datetime')->type('datetime');
        CRUD::column('total_price')->type('number')
            ->prefix('Rp ')
            ->decimals(2);
        CRUD::column('status')->type('select_from_array')
            ->options([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled'
            ]);
        CRUD::column('created_at');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::field('full_name')->attributes(['disabled' => 'disabled']);
        CRUD::field('phone_number')->attributes(['disabled' => 'disabled']);
        CRUD::field('barber_id')->type('select')
            ->entity('barber')
            ->attribute('barber_name')
            ->attributes(['disabled' => 'disabled']);
        CRUD::field('booking_datetime')->type('datetime')
            ->attributes(['disabled' => 'disabled']);
        CRUD::field('total_price')->type('number')
            ->prefix('Rp ')
            ->decimals(2)
            ->attributes(['disabled' => 'disabled']);
        CRUD::field('status')->type('select_from_array')
            ->options([
                'pending' => 'Pending',
                'confirmed' => 'Confirmed',
                'completed' => 'Completed',
                'cancelled' => 'Cancelled'
            ]);
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->setupListOperation();
        
        // Add services relationship
        CRUD::column('services')->type('relationship')
            ->attribute('pricing_name')
            ->label('Services');
    }
}
