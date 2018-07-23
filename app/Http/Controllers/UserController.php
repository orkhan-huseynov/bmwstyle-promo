<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin/users', [
            'users' => $users,
        ]);
    }

    public function edit(int $userId) {
        $user = User::findOrFail($userId);

        return view('admin/users-edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, int $userId) {
        $user = User::findOrFail($userId);

        $request->validate([
            'name' => 'required|min:3|max:255',
            'surname' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'phone' => 'required|min:17|max:17',
            'fin' => 'min:7|max:7',
            'date_of_birth' => 'required|date|min:10|max:10',
            'password' => 'confirmed',
            'car_model' => 'required|min:3',
            'car_lic_number' => 'required|min:9|max:9',
            'car_vin' => 'required|min:7|max:7',
        ]);

        if ($request->hasFile('photo')) {
            $filename_photo = time() . '_1' . '.' . $request->photo->getClientOriginalExtension();
            $path_photo = storage_path('/app/public/images/'.$filename_photo);
            Image::make($request->photo->getRealPath())->resize(500, null, function($constraint){
                $constraint->aspectRatio();
            })->save($path_photo);
            $user->photo = $filename_photo;
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->fin = $request->fin;
        $user->date_of_birth = Carbon::parse($request->date_of_birth);
        $user->car_model = $request->car_model;
        $user->car_lic_number = $request->car_lic_number;
        $user->car_vin = $request->car_vin;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('/admin/users');
    }
}
