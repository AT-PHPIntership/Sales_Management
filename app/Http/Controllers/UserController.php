<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests;
use App\Models\User;

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
     * Show the application accounts list
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        define('ACCOUNTS_PER_PAGES', 21);
        $users = User::paginate(ACCOUNTS_PER_PAGES);
        return view('users.index')->with('users', $users);
    }
}
