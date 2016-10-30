<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Auth;
use Image;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Http\Controllers\Admin\AdminController AS Controller;
use App\Models\Profession;
use Illuminate\Database\QueryException as Exception;
use App\Models\User;
use Carbon\Carbon;
use Session;

class UsersController extends Controller {

    /**
     * Profile Picture Upload Path
     */
    const UPLOAD_DIR = '/uploads/profile-picture/';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /*
         * n+1 problem:
         * This will execute 1 query to retrieve all of the users on the table,
         * then another query for each user's profile.
         * So, if we have 25 users, this loop would run 26 queries:
         * 1 for the original user,
         * and 25 additional queries to retrieve the profile of each user.
         *
         * select * from `users` where `users`.`deleted_at` is null
         * select * from `profiles` where `profiles`.`user_id` = '1' and `profiles`.`user_id` is not null limit 1
         * ---
         * select * from `profiles` where `profiles`.`user_id` = '2' and `profiles`.`user_id` is not null limit 1
         *
         */
        //$users = User::all();

        /*
         * Eager Loading:
         * Thankfully, we can use eager loading to reduce this operation
         * to just 2 queries. When querying, you may specify which relationships
         * should be eager loaded using the with method:
         * For this operation, only two queries will be executed:
         *
         * select * from `users` where `users`.`deleted_at` is null
         * select * from `profiles` where `profiles`.`user_id` in ('1', ..., '100')
         *
         */
        $users = User::with('profile', 'profession')->get();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $professions = Profession::pluck('name', 'id');
        return view('admin.users.create')->with('professions', $professions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request) {
        try {
            $data = $request->only(['profession_id', 'name', 'email']);
            $data['password'] = 'secret';
            $user = User::create($data);
            $profileData = $request->only(['bio', 'web', 'facebook', 'twitter', 'github']);
            $user->profile()->create($profileData);
            Session::flash('message', 'User added!');
            return redirect('admin/users');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withErrors($e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $professions = Profession::pluck('name', 'id');
        //returns object
        return view('admin.users.edit', compact('user', 'professions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user) {
        try {
            $data = $request->only(['profession_id', 'name', 'email']);
            $user->update($data);
            $profileData = $request->only(['bio', 'web', 'facebook', 'twitter', 'github']);
            $user->profile()->update($profileData);
            Session::flash('message', 'User added!');
            return redirect('admin/users');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withErrors($e->getMessage())
                            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        try {
            $name = $user->name;
            $user->delete();
            Session::flash('message', $name . ' deleted!');
            return redirect('admin/users');
        } catch (Exception $e) {
            return redirect()->back()
                            ->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing profile information.
     *
     * @return void
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileRequest $request
     *
     * @return void
     */
    public function updateProfile(ProfileRequest $request)
    {
        try {
            $user = $request->user();
            $user_data = $request->only(['name', 'email']);
            $profile_data = $request->only(['bio', 'web', 'facebook', 'twitter', 'github']);

            if ($request->hasFile('picture')) {
                $this->unlinkImage($user->profile->picture);
                $file = $request->file('picture');
                $profile_data['picture'] = $this->uploadImage($file);
            }

            $user->update($user_data);
            $user->profile()->update($profile_data);
            Session::flash('message', 'Your changes has been saved.');
            return redirect('admin/profile');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    /**
     * Upload profile Picture.
     *
     * @param  array $file
     *
     * @return string
     */
    private function uploadImage($file)
    {
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $image_file_name = $timestamp . '.' . $file->getClientOriginalExtension();
        Image::make($file)->resize(200, 300)->save(public_path() . self::UPLOAD_DIR . $image_file_name);
        //$file->move(public_path() . self::UPLOAD_DIR, $image_file_name);
        return $image_file_name;
    }

    /**
     * Remove Image.
     *
     * @param  string $img
     *
     * @return void
     */
    private function unlinkImage($img)
    {
        if ($img != '' && file_exists(public_path() . self::UPLOAD_DIR . $img)) {
            @unlink(public_path() . self::UPLOAD_DIR . $img);
        }
    }

    /**
     * Show the form for password change.
     *
     * @return void
     */
    public function password()
    {
        return view('admin.users.password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PasswordChangeRequest $request
     *
     * @return void
     */
    public function updatePassword(PasswordChangeRequest $request)
    {
        try {
            $user = $request->user();

            if (Hash::check($request->password, $user->password)) {
                $user->fill([
                    'password' => $request->new_password
                ])->save();
                Session::flash('message', 'Your changes has been saved.');
                return redirect('admin/password');
            } else {
                return redirect()->back()
                    ->withErrors('Current Password does not match.')
                    ->withInput();
            }

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }
}
