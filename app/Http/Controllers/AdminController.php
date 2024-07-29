<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $admins = Admin::orderBy('id', 'asc')->get();

        return view('admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'name' => 'required',
        'password' => 'required|min:6',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $admins = new Admin();
    $admins->username = $request->username;
    $admins->email = $request->email;
    $admins->name = $request->name;
    $admins->password = Hash::make($request->password);

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/photos', $filename);
        $admins->photo = $filename;
    }

    $admins->save();

    return redirect()->route('admin')->with('success', 'User added successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admins = Admin::findOrFail($id);
  
        return view('admin.show', compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admins = Admin::findOrFail($id);
  
        return view('admin.edit', compact('admins'));
    }

    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, string $id)
{
    // Validasi input dari form
    $request->validate([
        'username' => 'required|unique:users,username,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
        'name' => 'required',
        'password' => 'nullable|min:6', // Password boleh kosong
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Temukan admin berdasarkan ID
    $admins = Admin::findOrFail($id);
    
    // Update data admin
    $admins->username = $request->username;
    $admins->email = $request->email;
    $admins->name = $request->name;
    
    // Jika ada password baru, update password
    if ($request->filled('password')) {
        $admins->password = Hash::make($request->password);
    }

    // Jika ada foto baru yang diunggah, update foto
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($admins->photo) {
            Storage::delete('public/photos/' . $admins->photo);
        }

        // Unggah foto baru
        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('public/photos', $filename);
        $admins->photo = $filename;
    }

    // Simpan perubahan
    $admins->save();

    // Redirect dengan pesan sukses
    return redirect()->route('admin')->with('success', 'User updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admins = Admin::findOrFail($id);
  
        $admins->delete();
  
        return redirect()->route('admin')->with('success', 'product deleted successfully');
    }
}
