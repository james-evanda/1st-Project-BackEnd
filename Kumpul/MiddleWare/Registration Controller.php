namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|string|email|max:255|unique:users|regex:/^[^@]+@gmail\.com$/',
            'password' => 'required|string|min:6|max:12',
            'phone' => 'required|string|regex:/^08\d+$/',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'is_admin' => false,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please login.');
    }
}