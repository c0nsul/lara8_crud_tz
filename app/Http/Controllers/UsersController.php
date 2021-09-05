<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route("users.index")->withSuccess('User was successful created!');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @param User $userModel
     * @return Application|Factory|View
     */
    public function show($id, User $userModel)
    {
        $user = $userModel->find($id) ?? abort(404);
        return view('show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update($request->validated());

            return redirect()->route("users.index")->withSuccess('User was successfully updated!');

        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->withErrors('Error while user updating!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index")->withSuccess('User was successful deleted!');
    }
}
