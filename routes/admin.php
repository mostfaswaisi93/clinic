<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');

            Route::resources([
                'appointments'      => AppointmentsController::class,
                'patients'          => PatientsController::class,
                'services'          => ServicesController::class,
                'invoices'          => InvoicesController::class,
                'notifications'     => NotificationsController::class,
                'contacts'          => ContactsController::class,
                'countries'         => CountriesController::class,
                'cities'            => CitiesController::class,
                'states'            => StatesController::class,
                'payments'          => PaymentsController::class,
                'receipts'          => ReceiptsController::class,
                'transactions'      => TransactionsController::class,
                'roles'             => RolesController::class,
                'users'             => UsersController::class,
                'reports'           => ReportsController::class,
                'settings'          => SettingsController::class
            ]);

            Route::post('appointments/update', 'AppointmentsController@update')->name('appointments.update');
            Route::get('appointments/destroy/{id}', 'AppointmentsController@destroy');
            Route::post('appointments/updateStatus/{id}', 'AppointmentsController@updateStatus');

            Route::post('patients/update', 'PatientsController@update')->name('patients.update');
            Route::get('patients/destroy/{id}', 'PatientsController@destroy');
            Route::post('patients/updateStatus/{id}', 'PatientsController@updateStatus');

            Route::post('services/update', 'ServicesController@update')->name('services.update');
            Route::get('services/destroy/{id}', 'ServicesController@destroy');
            Route::post('services/delete_all', 'ServicesController@delete_all')->name('delete_all');
            Route::post('services/updateStatus/{id}', 'ServicesController@updateStatus');

            Route::get('invoices/destroy/{id}', 'InvoicesController@destroy');

            Route::get('notifications/destroy/{id}', 'NotificationsController@destroy');

            Route::get('contacts/destroy/{id}', 'ContactsController@destroy');

            Route::post('countries/update', 'CountriesController@update')->name('countries.update');
            Route::get('countries/destroy/{id}', 'CountriesController@destroy');
            Route::post('countries/updateStatus/{id}', 'CountriesController@updateStatus');

            Route::post('cities/update', 'CitiesController@update')->name('cities.update');
            Route::get('cities/destroy/{id}', 'CitiesController@destroy');
            Route::post('cities/updateStatus/{id}', 'CitiesController@updateStatus');

            Route::post('states/update', 'StatesController@update')->name('states.update');
            Route::get('states/destroy/{id}', 'StatesController@destroy');
            Route::post('states/updateStatus/{id}', 'StatesController@updateStatus');

            Route::get('payments/destroy/{id}', 'PaymentsController@destroy');

            Route::get('receipts/destroy/{id}', 'ReceiptsController@destroy');

            Route::get('transactions/destroy/{id}', 'TransactionsController@destroy');

            Route::post('roles/update', 'RolesController@update')->name('roles.update');
            Route::get('roles/destroy/{id}', 'RolesController@destroy');
            Route::post('roles/updateStatus/{id}', 'RolesController@updateStatus');

            Route::post('users/update', 'UsersController@update')->name('users.update');
            Route::get('users/destroy/{id}', 'UsersController@destroy');
            Route::post('users/updateStatus/{id}', 'UsersController@updateStatus');

            Route::get('reports/destroy/{id}', 'ReportsController@destroy');

            Route::get('settings', 'SettingsController@index')->name('settings.index');
            Route::post('settings', 'SettingsController@update')->name('settings.update');
        });
    }
);
