<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use DB;

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

            return redirect()->route('user.create')
                             ->withMessage(trans('users.successfull_message'));
        } catch (Exception $saveException) {
            // Catch exceptions when data cannot save.
            return redirect()->route('user.create')
                             ->withErrors(trans('users.error_message'));
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
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
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
        }

        return redirect()->route('user.index')->withErrors($errors);
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

        $result = User::whereRaw('`users`.`role_id` <> '
                . \Config::get('common.SUPERADMIN_ROLE_ID')
                . ' AND (`users`.`name` LIKE \'%'. $keyword
                .'%\' OR `users`.`id` LIKE \''. $keyword .'%\')')
                ->paginate(\Config::get('common.ACCOUNTS_PER_PAGES'));

        return view('users.index')->withKeyword($keyword)->withUsers($result);
    }
}
