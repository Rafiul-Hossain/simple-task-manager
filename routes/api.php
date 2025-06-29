use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::middleware('auth')->get('/tasks', [TaskController::class, 'apiIndex']); 