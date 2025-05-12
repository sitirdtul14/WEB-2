use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\OrderController;

// Routing Autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routing Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routing Pesanan
Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('order.detail');
Route::get('/orders/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::post('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
Route::post('/orders/{id}/delete', [OrderController::class, 'destroy'])->name('order.delete');
Route::get('/orders/{id}/print', [OrderController::class, 'print'])->name('order.print');