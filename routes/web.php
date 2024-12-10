<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/informazioni', function () {
    return view('organization.informations');
})->name('informations');

Route::get('/informazioni-nis2', function () {
    return view('organization.informations-nis2');
})->name('nis2.informations');

Route::get('/informazioni-controlli', function () {
    return view('organization.informations-controls');
})->name('controls.informations');

    Route::get(__('routes.execute_test') . '/{group?}', [OrganizationController::class, 'take'])->name('test.show');
    Route::post(__('routes.execute_test'), [OrganizationController::class, 'submit'])->name('test.submit');

    Route::get(__('routes.create_organization'), [OrganizationController::class, 'create'])->name('organization.create');
    Route::post(__('routes.create_organization'), [OrganizationController::class, 'store'])->name('organization.store');

    Route::get(__('routes.create_control'), [ControlController::class, 'create'])->name('control.create');
    Route::post(__('routes.create_control'), [ControlController::class, 'store'])->name('control.store');

    Route::get(__('routes.control_data'), [ControlController::class, 'showData'])->name('control.show-data');

    Route::get(__('routes.my_controls_index'), [ControlController::class, 'index'])->name('my-controls.index');
    Route::get(__('routes.my_organizations_index'), [OrganizationController::class, 'index'])->name('my-organizations.index');

    Route::get(__('routes.control_edit'), [ControlController::class, 'edit'])->name('control.edit');
    Route::put(__('routes.control_edit') , [ControlController::class, 'update'])->name('control.update');
    Route::delete(__('routes.control_edit'), [ControlController::class, 'destroy'])->name('control.destroy');

    Route::get(__('routes.organization_edit'), [OrganizationController::class, 'edit'])->name('organization.edit');
    Route::put(__('routes.organization_edit'), [OrganizationController::class, 'update'])->name('organization.update');
    Route::delete(__('routes.organization_edit'), [OrganizationController::class, 'destroy'])->name('organization.destroy');



Route::get(__('routes.organization_data'), [OrganizationController::class, 'showData'])->name('test.show-data');

Route::get(__('routes.my_organizations_index') . '/{organization}/results', [OrganizationController::class, 'listResults'])->name('results.list');

Route::get('/organizations/{organization}/results', [OrganizationController::class, 'listResults'])->name('organizations.results.list');
Route::get('/organizations/{organization}/results/{date}', [OrganizationController::class, 'showResultsDetails'])->name('results.details');


Route::get('change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'it'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('changeLanguage');


Route::middleware('auth')->group(function () {
    Route::get(__('routes.dashboard'), [RegisteredUserController::class, 'show'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get(__('routes.profile'), [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch(__('routes.profile'), [ProfileController::class, 'update'])->name('profile.update');
    Route::delete(__('routes.profile'), [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
