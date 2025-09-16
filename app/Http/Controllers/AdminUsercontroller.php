<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
  public function create()
  {
    $teachers = Teacher::all(); // Fetch all teachers
    return view('create_user', compact('teachers'));
  }

  public function edit(string $id)
  {
    $user = User::findOrFail($id);
    $teachers = Teacher::all();

    return view('edit_user', compact('user', 'teachers'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
      'role' => 'required|string',
      'teacher_id' => 'nullable|exists:teachers,id',
    ]);

    User::create([
      'name' => $validated['name'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
      'role' => $validated['role'],
      'teacher_id' => $validated['teacher_id'] ?? null,
    ]);
    $role = $validated['role'];
    $name = $validated['name'];

    ActivityLogger::log(
      'create user',
      "successfully added user account $name",
      'create',
      Auth::user()->id,
    );

    return redirect()->to(route('admin') . '#users')->with('success', "$role $name created");
  }

  public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'email'      => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique('users')->ignore($user->id), // abaikan email user ini
        ],
        'password'   => 'nullable|string|min:8', // opsional
        'role'       => 'required|string|in:admin,guru,evaluator', // batasi pilihan role
        'teacher_id' => 'nullable|exists:teachers,id',
    ]);

    $updateData = [
        'name'       => $validated['name'],
        'email'      => $validated['email'],
        'role'       => $validated['role'],
        'teacher_id' => $validated['teacher_id'] ?? null,
    ];

    // hanya update password kalau diisi
    if (!empty($validated['password'])) {
        $updateData['password'] = Hash::make($validated['password']);
    }

    $user->update($updateData);

    ActivityLogger::log(
      'update user',
      "successfully updated user account {$validated['name']}",
      'edit',
      Auth::user()->id,
    );

    return redirect()->to(route('admin') . '#users')
        ->with('success', $validated['role'] . ' ' . $validated['name'] . ' (' . $id . ') updated');
}

  public function destroy(string $id)
  {
    $user = User::findOrFail($id);
    $user->delete();

    ActivityLogger::log(
      'delete user',
      "successfully deleted user account $user->name",
      'delete',
      Auth::user()->id,
    );

    return redirect()->to(route('admin') . '#users')->with('success', 'User deleted successfully.');
  }
}
