<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use App\Category;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mencari semua data category yang ada
        $genres = Category::all();
        //kembali ke view dengan passing kategori-kategori tersebut
        return view('Genre.genre',['genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan halaman create category
        return view('Genre.add_genre');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mem-validasi data kategori baru
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);

        //jika validasi gagal maka akan di redirect bersamaan dengan error msg serta inputan sebelumnya
        if ($validator->fails()) {
            return redirect('genre/add')
                ->withErrors($validator)
                ->withInput();
        }
        //apabila validasi sukses maka di save
        $genre = new Category();
        $genre->name = $request['name'];
        $genre->save();

        //kembali ke view genre dengan pesan
        return redirect('/genre')->with('message','Create genre: '.$genre->name.' successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan data category yang ingin diedit
        $category = Category::find($id);
        //kembali ke view dengan passing data category yang ingin di edit
        return view('Genre.edit_genre', ['genre' => $category]);
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
        //mem-validasi data pembaharuan terhadap category yang telah ada
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);

        //jika validasi gagal maka akan redirect dengan error msg dan inputan sebelumnya
        if ($validator->fails()) {
            return redirect('genre/add')
                ->withErrors($validator)
                ->withInput();
        }

        //apabila berhasil maka data category diperbaharui sesuai data baru
        $genre = Category::find($id);
        $genre->name = $request['name'];
        $genre->save();

        //kembali ke genre dengan pesan
        return redirect('/genre')->with('message','Update genre: '.$genre->name.' successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //mencari category yang ingin dihapus berdasarkan idnya
        $genre = Category::find($id);
        $genre->delete();
        //kembali ke genre dengan pesan
        return redirect('/genre')->with('message','Delete genre: '.$genre->name.' successfull');
    }
}
