<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(5);

        return UserResource::collection($users);
    }

    public function create()
    {
        //
    }

    public function store(UserFormRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        return new UserResource($user);
    }

    public function show(string $id)
    {
        $user = User::FindOrFail($id);
        return new UserResource($user);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(UserFormRequest $request, string $id)
    {
        $user = User::FindOrFail($id);

        $data = $request->validated();

        if($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(string $id)
    {
        $user = User::FindOrFail($id);

        $user->delete();
    }
}
