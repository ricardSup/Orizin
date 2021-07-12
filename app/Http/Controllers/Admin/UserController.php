<?php

namespace App\Http\Controllers\Admin;

use Validator;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use DateTime;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mencari semua data user
        $users = User::all();
        //kembali ke view dengan data-data user tersebut
        return view('User.user',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //membuat halaman untuk meregistrasi user baru
        return view ('User.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mem-validasi data registrasi user
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'dob' => 'required|date|before:12 years ago',
            'pwd' => 'required|alpha_num|min:5',
            'c-pwd' => 'required_with:pwd|same:pwd|alpha_num|min:5',
            'file' => 'required|image|mimes:jpeg,bmp,png|max:2000'
        ]);
        //apabila validasi gagal maka akan di redirect serta error msg dan inputan sebelumnya
        if ($validator->fails()) {
            return redirect('user/add')
                ->withErrors($validator)
                ->withInput();
        }
       //mengambil request file
        $image = $request->file('file');
        //membuat nama file baru dengan di awali oleh waktu sekarang lalu disertai dengan ekstensi filenya
        $img = time().'.'.$image->getClientOriginalExtension();
        //standarisasi path penyimpanan file yang diupload
        $destinationPath = public_path('/images');
        //pindahkan file yang diupload ke path tersebut
        $image->move($destinationPath, $img);
        
        //save user baru dengan data-data yang telah divalidasi
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['pwd'];
        $user->DOB = date("Y-m-d", strtotime($request['dob']));
        $user->picture = $img;
        $user->save();
        //kembali ke view dengan pesan
        return redirect('/user')->with('message','Insert user: '.$user->name.' successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //mencari data-data user berdasarkan id yang diterima
        $user = User::find($id);
        //kembali ke view dengan data-data user tersebut
        return view('User.edit_user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //mem-validasi data-data user yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
           'email' => 'required|email|unique:users,email,'$id,
            'dob' => 'required|date|before:12 years ago',
            'pwd' => 'required|alpha_num|min:5',
            'c-pwd' => 'required_with:pwd|same:pwd|alpha_num|min:5',
            'file' => 'required|image|mimes:jpeg,bmp,png|max:2000'
        ]);
        //jika validasi gagal maka akan di redirect dengan error msg dan inputan sebelumnya
        if ($validator->fails()) {
            return redirect('user/add')
                ->withErrors($validator)
                ->withInput();
        }

       //mengambil request file
        $image = $request->file('file');
        //membuat nama file baru dengan di awali oleh waktu sekarang lalu disertai dengan ekstensi filenya
        $img = time().'.'.$image->getClientOriginalExtension();
        //standarisasi path penyimpanan file yang diupload
        $destinationPath = public_path('/images');
        //pindahkan file yang diupload ke path tersebut
        $image->move($destinationPath, $img);
        
        //perbaharui data user dengan data-data yang telah divalidasi
        $user = User::find($id);
        $user->name = $request['name'];
        $user->password = $request['pwd'];
        $user->DOB = date("Y-m-d", strtotime($request['dob']));
        $user->picture = $img;
        $user->save();

        //kembali ke view dengan pesan
        return redirect('/user')->with('message','Update user: '.$user->name.' successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //pencarian terhadap suatu user dan lakukan panghapusan
        $user = User::find($id);
        $user->delete();

        //kembali ke view dengan pesan
        return redirect('/user')->with('message','Delete user: '.$user->name.' successfull');
    }
}
