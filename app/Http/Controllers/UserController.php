<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Validators;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user');
    }


    public function getUsers(Request $request)
    {
        try {
            if ($request->ajax()) {
                $users = User::select(['id', 'name', 'email', 'mobile', 'profile_image'])->orderBy('id', 'desc');

                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('profile_image', function ($row) {
                        if ($row->profile_image) {
                            $imageUrl = url("storage/" . $row->profile_image);
                            return '<img src="' . $imageUrl . '" class="w-12 h-12 rounded-full object-cover" alt="Profile Image">';
                        } else {
                            return '<span class="text-gray-400">No Image</span>';
                        }
                    })

                    ->addColumn('action', function ($row) {
                        return '
                    <a href="' . route('users.edit', $row->id) . '" class="text-blue-600">Edit</a> | 
                    <a href="' . route('users.delete', $row->id) . '" class="delete-user text-red-600">Delete</a>
                ';
                    })
                    ->rawColumns(['profile_image', 'action'])
                    ->make(true);
            }
        } catch (Exception $err) {
            return redirect()->back()->withInput()->with('error', $err->getMessage());
        }
    }

    public function create()
    {
        return view('pages.user-create');
    }

    public function save(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255|regex:/^[a-zA-Z ]+$/u',
                'password' => 'required_without:id|min:8',
            ];

            $id = $request->input('id');

            if ($id) {
                $rules['email'] = 'required|email|unique:users,email,' . $id;
                $rules['mobile'] = 'required|max:10|min:10|regex:/^[0-9]+$/u|unique:users,mobile,' . $id;
            } else {
                $rules['email'] = 'required|email|unique:users,email';
                $rules['mobile'] = 'required|max:10|min:10|regex:/^[0-9]+$/u|unique:users,mobile';
            }

            $validate = Validator::make($request->all(), $rules, [
                'name.required' => 'Name is required.',
                'name.string' => 'Name must be a string.',
                'name.max' => 'Name must not exceed 255 characters.',
                'name.regex' => 'Name can only contain letters and spaces.',

                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already taken.',

                'mobile.required' => 'Mobile number is required.',
                'mobile.max' => 'Mobile number must be exactly 10 digits.',
                'mobile.min' => 'Mobile number must be exactly 10 digits.',
                'mobile.unique' => 'This mobile number is already registered.',
                'mobile.regex' => 'Mobile number must only contain digits.',

                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
            ]);

            if ($validate->fails()) {
                $errorMessage = $validate->errors()->first();
                return redirect()->back()->withInput()->with('error', $errorMessage);
            }


            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            $profile_image = null;
            if ($request->hasFile('profileImage')) {
                $file = $request->file('profileImage');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('images', $filename, 'public');
                $profile_image = $filePath;
            }

            if ($id) {
                $user = User::find($id);

                if ($user) {
                    $user->name = $name;
                    $user->email = $email;
                    $user->mobile = $mobile;
                    if ($profile_image) {
                        $user->profile_image = $profile_image;
                    }

                    $user->save();

                    return redirect()->route('home')->withInput()->with('success', 'User updated successfully');
                }
            } else {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'mobile' => $mobile,
                    'password' => Hash::make($password),
                    'profile_image' => $profile_image
                ]);

                if ($user) {
                    return redirect()->route('home')->withInput()->with('success', 'User created successfully');
                } else {
                    return redirect()->back()->withInput()->with('error', "Can't create user. Please try again later.");
                }
            }
        } catch (Exception $err) {
            return redirect()->back()->withInput()->with('error', $err->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user-edit', compact('user'));
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('home')->with('success', 'User deleted successfully');
        } catch (Exception $err) {
            return redirect()->back()->with('error', $err->getMessage());
        }
    }


    public function export()
    {
        $users = User::select('id', 'name', 'email', 'mobile')->get();
        $csvFile = fopen('php://output', 'w');
        fputcsv($csvFile, ['ID', 'Name', 'Email', 'Mobile']);
        foreach ($users as $user) {
            fputcsv($csvFile, [$user->id, $user->name, $user->email, $user->mobile]);
        }
        return Response::stream(function () use ($csvFile) {
            fclose($csvFile);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);
    }
}