<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Response;
use Image;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('id')->get();

        $lastUpdate = (count($users) > 0)? $users->last()->updated_at->format('d.m.Y H:i') : null;

        return view('admin/users', [
            'users' => $users,
            'lastUpdate' => $lastUpdate,
        ]);
    }

    public function add() {
        return view('admin/users-add');
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
            $path_photo = storage_path('app/public/images/'.$filename_photo);
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

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'surname' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'email' => 'required|email|min:3|max:255',
            'phone' => 'required|min:17|max:17',
            'fin' => 'min:7|max:7',
            'date_of_birth' => 'required|date|min:10|max:10',
            'password' => 'confirmed',
            'car_model' => 'required|min:3',
            'car_lic_number' => 'required|min:9|max:9',
            'car_vin' => 'required|min:7|max:7',
        ]);

        $user = new User();

        if ($request->hasFile('photo')) {
            $filename_photo = time() . '_1' . '.' . $request->photo->getClientOriginalExtension();
            $path_photo = storage_path('app/public/images/'.$filename_photo);
            Image::make($request->photo->getRealPath())->resize(500, null, function($constraint){
                $constraint->aspectRatio();
            })->save($path_photo);
            $user->photo = $filename_photo;
        }

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->fin = $request->fin;
        $user->date_of_birth = Carbon::parse($request->date_of_birth);
        $user->car_model = $request->car_model;
        $user->car_lic_number = $request->car_lic_number;
        $user->car_vin = $request->car_vin;
        $user->group_id = 10;

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('/admin/users');
    }

    function destroy(int $userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return Response::json([
            'responseCode' => 1,
            'responseMessage' => 'ok',
        ]);
    }
}
