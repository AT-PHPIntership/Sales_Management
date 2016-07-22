<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateAccountRequest;
use App\Models\User;
use Exception;
use Redirect;
use Hash;
use Image;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\UserRequest $request User request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $user = new User($request->all());
            $user->save();
            return redirect()->route('user.create')->withMessage(trans('users.successfull_message'));
        } catch (Exception $saveException) {
            return redirect()->route('user.create')->withErrors(trans('users.error_message'));
        }
    }
    
    /**
     * Show the application user profile
     *
     * @param integer $id determine specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->route('user.index')->withErrors(trans('users.error_message'));
        }
    }
    
    /**
     * Show the application accounts list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(\Config::get('common.ACCOUNTS_PER_PAGES'));
        return view('users.index')->with('users', $users);
    }

    /**
     * Destroy the specified account from database.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $errors = trans('users.delete.error_message');
        try {
            $user = User::findOrFail($id);
            $numberOfBills = count($user->bills);
            $numberOfOrders = count($user->orders);
            if ($numberOfOrders || $numberOfBills) {
                $errors = trans('users.delete.delete_unsuccessful');
            } else {
                $userName = $user->name;
                $user->delete();
                return redirect()->route('user.index')
                                 ->withMessage($userName.trans('users.delete.delete_successful'));
            }
        } catch (Exception $modelNotFound) {
            return redirect()->route('user.index')->withErrors(trans('users.error_message'));
        }
        return redirect()->route('user.index')->withErrors($errors);
    }
    
    /**
     * Update user infomation
     *
     * @param Request $request hold all data from request
     * @param integer $id      determine specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $input = $request->all();
            $user = User::findOrFail($id);
            unset($input['birthday']);
            $user->fill($input);
            $user->birthday = date(\Config::get('common.DATE_YMD_FORMAT'), strtotime($request->birthday));
            $user->save();
            return Redirect::back()->withMessage(trans('users.edit.edit_successful_message'))->withInput();
        } catch (Exception $saveException) {
            return Redirect::back()->withErrors(trans('users.error_message'));
        }
    }
    
    /**
     * Update user account
     *
     * @param Request $request hold all data from request
     * @param integer $id      determine specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(UserUpdateAccountRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if (Hash::check($request->current_password, $user->password)) {
                $user->password= $request->password;
                $user->save();
                return Redirect::back()->withMessage(trans('users.edit.edit_account_successful_message'));
            }
            return Redirect::back()->withErrors(trans('users.edit.error_password_incorrect'));
        } catch (Exception $saveException) {
            return Redirect::back()->withErrors(trans('users.error_message'));
        }
    }
    
    /**
     * Update user avatar
     *
     * @param Request $request hold all data from request
     * @param integer $id      determine specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $file = $request->file('image');
            if ($file) {
                $filename = $user->id . '.' .$file->getClientOriginalExtension();
                $path = base_path() . '/public/file/avatar';
                Image::make($file)->fit(\Config::get('common.IMAGE_WIDTH'), \Config::get('common.IMAGE_HEIGHT'))->save($path. '/' .$filename);
                $user->avatar = $filename;
                $user->update();
                return Redirect::back()->withMessage(trans('users.edit.edit_avatar_successful_message'));
            }
            return Redirect::back()->withErrors(trans('users.edit.error_password_incorrect'));
        } catch (Exception $saveException) {
            return Redirect::back()->withErrors(trans('users.error_message'));
        }
    }
    
    /**
     * Show the application edit form
     *
     * @param integer $id determine specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->route('user.index')->withErrors(trans('users.error_message'));
        }
    }
    
    /**
     * Search user in database
     *
     * @param Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)
    {
        $keyword = $request->q;
        $result = User::where('role_id', '!=', \Config::get('common.SUPERADMIN_ROLE_ID'))
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('id', 'like', $keyword . '%')
                ->paginate(\Config::get('common.ACCOUNTS_PER_PAGES'));

        return view('users.index')->withKeyword($keyword)->withUsers($result);
    }
}
