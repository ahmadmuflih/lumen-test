<?php
namespace App\Http\Controllers;

use App\Http\Resources\UserResources;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    // Semua throwable error di-handle di App/Exception/Handler.php
    // agar code lebih clean dan tidak harus meng-catch semua error di tiap endpoint.

    public function index(Request $request)
    {
        if($request->with){ // Jika ada param with
            $relations = explode(',',$request->with); // Ubah menjadi array berdasarkan koma
            $data['users'] = UserResources::collection(User::with($relations)->get());
        }
        else{
            $data['users'] = UserResources::collection(User::all());
        }
        return response()->json([
            'status' => 'success',
            'data'   => $data
        ], 200);
    }

    // Saya menganggap parameter user adalah user id karena begitu umumnya
    public function view(Request $request, string $user)
    {
        $data['user'] = new UserResources(User::findOrFail($user));
        return response()->json([
            'status' => 'success',
            'data'   => $data
        ], 200);
    }

}
