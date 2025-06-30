<?php
namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
   public function index()
   {
       return User::all(); // GET /api/users
   }


   public function store(Request $request)
   {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users',
           'password' => 'required|string|min:6',
       ]);


       $validated['password'] = Hash::make($validated['password']);
       return User::create($validated); // POST /api/users
   }


   public function show($id)
   {
       return User::findOrFail($id); // GET /api/users/{id}
   }


   public function update(Request $request, $id)
   {
       $user = User::findOrFail($id);


       $validated = $request->validate([
           'name' => 'sometimes|required|string|max:255',
           'email' => "sometimes|required|email|unique:users,email,{$id}",
           'password' => 'nullable|string|min:6',
       ]);


       if (isset($validated['password'])) {
           $validated['password'] = Hash::make($validated['password']);
       }


       $user->update($validated);
       return $user; // PUT /api/users/{id}
   }


   public function destroy($id)
   {
       $user = User::findOrFail($id);
       $user->delete(); // DELETE /api/users/{id}
       return response()->json(['message' => 'User deleted']);
   }
}
