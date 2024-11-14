    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\EmployeeController;

    Route::get('/', function () {
        return view('welcome');
    });
    // Route::get('/add', function () {
    //     return view('employeeAdd');
    // });
    // Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

    Route::resource('employees', EmployeeController::class);
