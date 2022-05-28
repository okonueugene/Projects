<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Organization\SiteController;
use App\Http\Livewire\Guards\Guards;
use App\Http\Livewire\Guards\Overview as GuardsOverview;
use App\Http\Livewire\Sites\Access;
use App\Http\Livewire\Sites\CreatePatrol;
use App\Http\Livewire\Sites\Dobs;
use App\Http\Livewire\Sites\Guards as SitesGuards;
use App\Http\Livewire\Sites\Notifications;
use App\Http\Livewire\Sites\Overview;
use App\Http\Livewire\Sites\Patrols;
use App\Http\Livewire\Sites\Tags;
use App\Http\Livewire\Sites\Tasks;
use App\Http\Livewire\Sites\Incidents;
use App\Http\Livewire\Sites\LatestActivity;
use App\Http\Livewire\Visitor\Log;
use App\Http\Livewire\Visitor\Visitors;
use App\Http\Livewire\Reports\Patrol;
use App\Http\Livewire\Reports\Attendance;
use App\Http\Livewire\Reports\Visitor;
use App\Http\Livewire\Reports\Task;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('register', [RegisterController::class,'showRegistrationForm'])
  ->name('register')
  ->middleware('hasInvitation');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'],function () {

    //Super Admin Routes
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'super-admin',
        'as' => 'admin.'
    ], function () {
        Route::get('/dashboard', function ()
        { return view('admin.dashboard'); });
    });

    //Organization routes
    Route::group([
        'prefix' => 'app',
        'middleware' => 'organization',
        'as' => 'org.'
    ], function () {
        Route::get('/dashboard', function ()
        { return view('organization.dashboard', with(['title' => 'Dashboard'])); })->name('dashboard');
        
        Route::resource('roles', App\Http\Controllers\Organization\RoleController::class);
        Route::get('team', [App\Http\Controllers\Organization\TeamController::class, 'index'])->name('team.index');
        Route::get('/team/invitations', [App\Http\Controllers\Organization\TeamController::class, 'invitations'])->name('invitations');
        Route::resource('/team', App\Http\Controllers\Organization\TeamController::class);
        Route::get('/tracking/map', [App\Http\Controllers\Organization\SiteController::class, 'viewMap'])->name('sites-map');
        Route::get('/clients', [App\Http\Controllers\Organization\SiteController::class, 'viewClients'])->name('clients');
        Route::post('/sites/{site}/location', [App\Http\Controllers\Organization\SiteController::class, 'updateLocation'])->name('update-location');
        Route::post('/sites/{site}/edit', [App\Http\Controllers\Organization\SiteController::class, 'update'])->name('update-site');
        Route::get('/sites/{site}/overview', Overview::class)->name('site-overview');
        Route::get('/sites/{site}/access', Access::class)->name('site-access');
        Route::get('/sites/{site}/guards', SitesGuards::class)->name('site-guards');
        Route::get('/sites/{site}/tags', Tags::class)->name('site-tags');
        Route::get('/sites/{site}/patrols', Patrols::class)->name('site-patrols');
        Route::get('/sites/{site}/patrols/create', CreatePatrol::class)->name('site-create-patrol');
        Route::resource('/sites', App\Http\Controllers\Organization\SiteController::class);
        Route::get('/guards', Guards::class)->name('guards-list');
        Route::get('/guards/{guard}/overview', GuardsOverview::class)->name('guard-overview');
        Route::get('/visitors', Visitors::class)->name('visitors-list');
        Route::get('/reports/patrolreports', Patrol::class)->name('patrol-reports');
        Route::get('/reports/attendancereports', Attendance::class)->name('attendance-reports');
        Route::get('/reports/visitorreports', Visitor::class)->name('visitor-reports');
        Route::get('/reports/taskreports', Task::class)->name('task-reports');
        
        
        
        Route::get('/visitor/log', Log::class)->name('visitors-log');
        Route::get('sites/{site}/tasks', Tasks::class)->name('site-tasks');
        Route::get('/sites/{site}/dobs', Dobs::class)->name('site-dobs');
        Route::get('sites/{site}/incidents', Incidents::class)->name('site-incidents');
        Route::get('sites/{site}/latestactivity', LatestActivity::class)->name('site-latestactivity');
        Route::get('/sites/{site}/notifications', Notifications::class)->name('site-notifications');

    });

    //Client Area routes
    Route::group([
        'prefix' => 'client',
        'middleware' => 'client',
        'as' => 'client.'
    ], function () {
        Route::get('/dashboard', function ()
        { return view('organisation.client.dashboard'); });
    });
});