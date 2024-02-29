<?php

namespace App\Http\Controllers;
use App\Models\User;
use Response;
use Validator;
use App\Jobs\UserCreatedJob;



use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // function index(Request $request){
    //     return User::all();
    // }
    // function create(Request $request){

    // }
    function store(Request $request){
        // $this->validate($request, [
        //     'email' => 'required|email|unique:users',
        //     'firstName' => 'required',
        //     'lastName' => 'required',

        // ]);
        
        $validator = Validator::make($request->all(), [
               'email' => 'required|email|unique:users',
            'firstName' => 'required',
            'lastName' => 'required',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }

        $user = User::create($request->only('email','firstName','lastName'));
        UserCreatedJob::dispatch($user->toArray());
        return response($user, \Illuminate\Http\Response::HTTP_CREATED);
    }

    // function show(Request $request){

    // }
    // function edit(Request $request){

    // }
    // function update(Request $request){

    // }
    // function destroy(Request $request){

    // }
}
