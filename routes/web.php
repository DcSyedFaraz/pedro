<?php

use App\Http\Controllers\Admin\MoodReportController;
use App\Http\Controllers\Admin\ProblemReportingController;
use App\Http\Controllers\Manager\LocationController;
use App\Http\Controllers\Manager\ResponceController;
use Illuminate\Support\Facades\Route;
// Admin Dashboard
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\InspectionCategoryController;
use App\Http\Controllers\Admin\JobPerAssignController;
use App\Http\Controllers\Admin\JobPerRegionController;
use App\Http\Controllers\Admin\ReadyInvoiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkOrdersController as adminWorkOrderController;
use App\Http\Controllers\Admin\TechniciansController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CheckListController;
use App\Http\Controllers\Admin\InspectionController;

use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\JobSubCategoryController;
use App\Http\Controllers\Admin\JobPriorityCategoryController;
use App\Http\Controllers\Admin\JobSourceCategoryController;
use App\Http\Controllers\Admin\EstimateController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeneralSettingController;

// users Dashboard
use App\Http\Controllers\users\DashboardController as usersDashboardController;
use App\Http\Controllers\users\UsersController;
use App\Http\Controllers\users\userInvoiceController;
use App\Http\Controllers\users\userEstimateController;
use App\Http\Controllers\users\userJobController;


// Vendor Dashboard
use App\Http\Controllers\vendor\DashboardController as vendorDashboardController;
use App\Http\Controllers\vendor\VendorController;

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
Route::get('/signup', [RegisterController::class, 'register_form'])->name('signup');
Route::get('logout', [LoginController::class, 'logout']);
Route::get('account/verify/{token}', [LoginController::class, 'verifyAccount'])->name('users.verify');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/', [HomeController::class, 'login']);
Route::get('/', [HomeController::class, 'index']);
// Route::get('test', function () {
//     event(new App\Events\StatusLiked('Someone'));
//     return "Event has been sent!!";
// });

Route::get('/manager/dashboard', [HomeController::class, 'manager'])->name('manager.dashboard');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:Admin']], function () {

    Route::get('/change_password', [DashboardController::class, 'change_password'])->name('change_password');
    Route::post('/store_change_password', [DashboardController::class, 'store_change_password'])->name('store_change_password');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('users', UserController::class);

    Route::get('/customer', [UserController::class, 'customer'])->name('customer.index');
    Route::get('/customer/create', [UserController::class, 'customer_create'])->name('customer.create');
    Route::post('/customer/store', [UserController::class, 'customer_store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [UserController::class, 'customer_edit'])->name('customer.edit');
    Route::put('/customer/update/{id}', [UserController::class, 'customer_update'])->name('customer.update');
    Route::delete('/customer/destroy/{id}', [UserController::class, 'customer_destroy'])->name('customer.destroy');
    Route::get('/service/destroy/{id}', [UserController::class, 'service_destroy'])->name('service.destroy');
    Route::get('/pricontact/destroy/{id}', [UserController::class, 'pri_destroy'])->name('pri.destroy');




    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile.index');
    // Storage
    Route::get('/document', [DashboardController::class, 'document'])->name('document');
    Route::get('/signature', [DashboardController::class, 'signature'])->name('signature');
    Route::post('profile/update', [DashboardController::class, 'update'])->name('profile.update');
    Route::resource('general_setting', GeneralSettingController::class);
    // Routes for work
    Route::get('/work-orders', [adminWorkOrderController::class, 'index'])->name('admin.work_orders.index');
    Route::resource('technicians', TechniciansController::class);

    //Problem Reporting
    Route::resource('problem', ProblemReportingController::class);

    Route::resource('estimates', EstimateController::class);
    Route::post('estimates/update-selected-jobs', [EstimateController::class, 'updateSelectedJobs'])->name('estimates.updateSelectedJobs');
    Route::get('/estimatepri/destroy/{id}', [EstimateController::class, 'est_pri'])->name('estpri.destroy');

    //Ready Invoice
    Route::resource('readyinvoice', ReadyInvoiceController::class);

    //Mood Reporting
    Route::resource('moodreport', MoodReportController::class);


    //Task
    Route::resource('task', TaskController::class);

    Route::resource('job-category', JobCategoryController::class);
    Route::resource('job-sub-category', JobSubCategoryController::class);
    Route::resource('job-priority', JobPriorityCategoryController::class);
    Route::resource('job-source', JobSourceCategoryController::class);

    Route::resource('job', JobController::class);
    Route::resource('products', ProductController::class);
    Route::resource('purchase-orders', PurchaseOrderController::class);
    Route::resource('inventory', InventoryController::class);
    Route::get('/product/delete/{id}', [InventoryController::class, 'product_destroy'])->name('productService.destroy');
    Route::resource('invoice', InvoiceController::class);
    Route::resource('checklist', CheckListController::class);
    Route::resource('inspection', InspectionController::class);
    Route::resource('jobpermanager', JobPerAssignController::class);
    Route::resource('jobperregion', JobPerRegionController::class);

    Route::get('/checklists/finalized', [CheckListController::class, 'finalized'])->name('finalized');
    Route::get('/checklists/location', [CheckListController::class, 'location'])->name('location');
    Route::get('/checklists/response/{id}', [CheckListController::class, 'response'])->name('adminresponse');

    Route::get('get-subcategories', [JobController::class, 'getSubcategories'])->name('get-subcategories');
    Route::get('/get-subdescription', [JobController::class, 'getSubDescription'])->name('get-subdescription');
    Route::get('/today-schedule-job', [JobController::class, 'TodaySchedule'])->name('today.job.schedule');
    Route::get('/next-48-hours-job', [JobController::class, 'Next48Hours'])->name('today.job.next.48.hours');
    Route::get('/jobs-needing-scheduling', [JobController::class, 'JobsNeedingScheduling'])->name('job.needing.scheduling');
    Route::get('/jobs-in-progress', [JobController::class, 'JobsInProgress'])->name('jobs.in.progress');
    Route::get('/jobs-complete', [JobController::class, 'JobsInCompleted'])->name('jobs.complete');
    Route::get('/jobprimary/destroy/{id}', [JobController::class, 'job_pri'])->name('jobpri.destroy');
    Route::put('/jobassign/update/{id}', [JobController::class, 'job_assign'])->name('jobassign.update');



});
Auth::routes();
Route::group(['prefix' => 'users', 'middleware' => ['auth', 'role:User']], function () {

    //Work Order
    Route::get('/work-orders/index', [UsersController::class, 'index'])->name('users.work-orders.index');
    Route::post('/assign-vendor/store', [UsersController::class, 'storeWorkOrder'])->name('users.assign_vendor.store');
    Route::resource('work-orders', UsersController::class);
    Route::post('/feedback', [UsersController::class, 'completeOrder'])->name('users.complete.order');
    Route::get('/change/password', [usersDashboardController::class, 'users_change_password'])->name('users.change_password');
    Route::post('/store/change/password', [usersDashboardController::class, 'users_store_change_password'])->name('users.store_change_password');
    Route::get('/dashboard', [usersDashboardController::class, 'index'])->name('users.dashboard');

    //Job
    Route::resource('joblist', userJobController::class);

    //Estimate
    Route::resource('estimate', userEstimateController::class);

    //invoice
    Route::resource('invoices', userInvoiceController::class);

    //problem
    Route::get('/problem', [usersDashboardController::class, 'problem'])->name('users.problem');
    Route::get('/problem/show/{id}', [usersDashboardController::class, 'problemshow'])->name('users.problem.show');

    //inspection
    Route::get('/inspection', [usersDashboardController::class, 'inspection'])->name('users.inspection');
    Route::get('/inspection/show/{id}', [usersDashboardController::class, 'inspectionshow'])->name('users.inspection.show');

    //users Profile
    Route::get('/profile', [usersDashboardController::class, 'profile'])->name('users.profile');
    Route::post('/update/profile', [usersDashboardController::class, 'usersProfileUpdate'])->name('users.profile.update');
    Route::post('/edit/profile', [usersDashboardController::class, 'user_edit_profile'])->name('users.edit.profile');
    Route::post('/bank/detail', [usersDashboardController::class, 'usersBankDetail'])->name('users.bank.detail');

});

Route::group(['prefix' => 'vendor', 'middleware' => ['auth']], function () {

    //Manage Work Order & Execute Work Order
    Route::get('/manage/work/orders', [vendorController::class, 'manageWorkOrders'])->name('manage_work_orders');
    Route::get('/execute/work/order', [vendorController::class, 'executeWorkOrder'])->name('execute_work_order');
    Route::get('/dashboard', [vendorDashboardController::class, 'index'])->name('vendor.dashboard');
    //users Profile
    Route::get('/profile', [vendorDashboardController::class, 'profile'])->name('vendor.profile');
    Route::post('/update/profile', [vendorDashboardController::class, 'usersProfileUpdate'])->name('vendor.profile.update');
    Route::post('/edit/profile', [vendorDashboardController::class, 'usersEditProfile'])->name('vendor.edit.profile');
    Route::post('/bank/detail', [vendorDashboardController::class, 'usersBankDetail'])->name('vendor.bank.detail');
    //Vendor Work order
    Route::get('/vendor/work-orders', [vendorDashboardController::class, 'manageWorkOrders'])->name('vendor.manage.work.order');
    Route::get('/vendor/work-orders/{id}/execut', [vendorDashboardController::class, 'executeWorkOrder'])->name('vendor.execute.work.order');
    Route::post('/vendor/deliver/order', [vendorController::class, 'deliverOrder'])->name('vendor.deliver_order');

});
Route::group(['prefix' => 'manager', 'middleware' => ['auth','role:account manager']], function () {


    //Inspection
    Route::resource('checklists', InspectionController::class);

    //Location
    Route::resource('location', LocationController::class);

    //Responce
    Route::resource('responce', ResponceController::class);

});
