namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // or a Provider model if you separate sitters/walkers

class DashboardController extends Controller
{
    public function index()
    {
        // Get available pet sitters/walkers
        $providers = User::where('role', 'provider')->paginate(9); // adjust based on your DB
        return view('dashboard.index', compact('providers'));
    }
}