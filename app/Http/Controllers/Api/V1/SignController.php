<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use Illuminate\Support\Facades\Hash;

class SignController extends ApiController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function signUp(SignUpRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $this->sendResponse($user, 'User register successfully.', 201);
    }

    /**
     * @param SignInRequest $request
     * @return mixed
     */
    public function signIn(SignInRequest $request)
    {
        $data = $request->validated();

        /** @var User $user */
        $user = User::where('email', $data['email'])->first();

        if (!Hash::check($data['password'], $user->password)) {
            return $this->sendError("Email or password incorrect!", 403);
        }

        $token = $user->createToken('guestbook')->accessToken;

        return $this->sendResponse($token, 'Success.', 200);

    }

}
