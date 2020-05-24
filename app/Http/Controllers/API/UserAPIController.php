<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use App\User;
use Response;
use Hash;
use Exception;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    private $request;

    public function __construct(UserRepository $userRepo, Request $request)
    {
        $this->userRepository = $userRepo;
        $this->request = $request;
    }

    public function register()
    {
        $this->request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = $this->userRepository->findEmail($this->request->input('email'));
        if($user)
            return $this->sendError('User with this email exists');

        $user = $this->userRepository->create([
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'password' => Hash::make($this->request->input('password'))
        ]);

        return $this->sendResponse([
            'user' => $user,
            'token' => $user->createToken('booke')->accessToken
        ], 'User Registered Successfully');
    }

    public function login()
    {
        $this->request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = $this->userRepository->findEmail($this->request->input('email'));

        if(!$user || !Hash::check($this->request->input('password'), $user->password))
            return $this->sendError('Invalid email or password');

        return $this->sendResponse([
            'user' => $user,
            'token' => $user->createToken('booke')->accessToken
        ], 'User Login Successfully');
    }

    public function details()
    {
        $user = auth()->user();
        return $this->sendSuccess($user->toArray());
    }

    public function logout()
    {
        $token = $this->request->user()->token()->revoke();
        return $this->sendSuccess('User Logged out successfully');
    }

    public function updateName()
    {
        $user = $this->findUser();

        $user->update([
            'name' => $this->request->input('name')
        ]);

        return $this->sendResponse($user->toArray(), 'Name Updated Successfully');
    }

    public function updatePhone()
    {
        $user = $this->findUser();

        $user->update([
            'phone' => $this->request->input('phone')
        ]);
        return $this->sendResponse($user->toArray(),'Name Updated Successfully');
    }

    protected function findUser()
    {
        return User::query()->findOrFail(auth()->user()->id);
    }

}
