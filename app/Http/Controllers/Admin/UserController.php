<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Hash;
use App\User;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin.auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $name = $request->name;
        $email = $request->email;
        if($request->ajax()){
            
            $userList = User::select('*');
            if(isset($name) && !empty($name)){
                $userList->where('name','LIKE','%'.$name.'%');
            }
            if(isset($email) && !empty($email)){
                $userList->where('email','LIKE', '%'.$email.'%');
            }
            //$userList->orderby('id','DESC');
            
            return Datatables::of($userList)
                ->editColumn('status', function($row) {
                    if($row->status === 'D'){
                        return 'Disable';
                    }else{
                        return 'Active';
                    }
                })
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $vurl = route('users.show',$row->id);
                        $eurl = route('users.edit',$row->id);
                        $durl = route('users.destroy',$row->id);
                        $btn = '<a href="javascript:void(0)" class="show btn btn-info btn-sm" action="'.$vurl.'" >View</a>&nbsp;';
                        $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" action="'.$eurl.'">Edit</a>&nbsp;';
                        $btn = $btn.'<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" action="'.$durl.'">Delete</a>&nbsp;';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request){
        //validation
        $message = ['status'=>false, 'message'=>'Oops! Something went wrong.','data' => ''];
        $validated = $request->validated();
        $userDetail = '';
        if(isset($validated) && !empty($validated) && count($validated)){
            $userDetail =  User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]);

            if(!empty($userDetail)){
                $message = ['status'=>true, 'message'=>'User created successfully','data' => $userDetail];
            }else{
                $message = ['status'=>false, 'message'=>'Unable to create user.','data' => ''];
            }
        }
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $userDetail = User::where('id',$id)->first();
        if(!empty($userDetail)){
            return response()->json(['status'=>true, 'message'=>'User retrieved successfully','data' => $userDetail]);
        }else{
            return response()->json(['status'=>false, 'message'=>'Unable to retrieve user.','data' => '']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $userDetail = User::where('id',$id)->first();
        if(!empty($userDetail)){
            return response()->json(['status'=>true, 'message'=>'User retrieved successfully','data' => $userDetail]);
        }else{
            return response()->json(['status'=>false, 'message'=>'Unable to retrieve user.','data' => '']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id){
        //validation
        $message = ['status'=>false, 'message'=>'Oops! Something went wrong.','data' => ''];
        $validated = $request->validated();
        $userDetail = '';
        
        if(isset($validated) && !empty($validated) && count($validated)){
            $user = User::findOrFail($id);
            $user->name = $validated['name'];
            $user->email =  $validated['email'];
            $user->status =  $validated['status'];
            if($validated['password'] !== null){
                //echo 'dff';
                $user->password =  Hash::make($validated['password']);
            }
            $userDetail = $user->save();

            if(!empty($userDetail)){
                $message = ['status'=>true, 'message'=>'User updated successfully','data' => $userDetail];
            }else{
                $message = ['status'=>false, 'message'=>'Unable to update user.','data' => ''];
            }
        }
        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = ['status'=>false, 'message'=>'Oops! Something went wrong.','data' => ''];
        if(!empty($id) && $id > 0){
            $isDeleted = User::find($id)->delete($id);
            if(!empty($isDeleted) && $isDeleted === true){
                $message = ['status'=>true, 'message'=>'User deleted successfully','data' => $isDeleted];
            }else{
                $message = ['status'=>false, 'message'=>'Unable to delete user.','data' => ''];
            }
        }
        return response()->json($message);
    }
}
