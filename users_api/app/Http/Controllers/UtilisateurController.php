<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;

class UtilisateurController extends Controller
{

    public function index()
    {
        // Get all data from db
        $utilisateurs = Utilisateur::all();
        return response()->json($utilisateurs);
    }



    public function store(Request $request)
    {
        //POST data to db from user (form)
        // 1.Validation
        $this->validate($request,[
            'photo'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'username'=>'required',
            'password'=>'required',
        ]);
        $utilisateur = new Utilisateur();

        // 2. image upload
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedfileExtension = ['pdf','png','jpeg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);

            if($check){
                $name = time().$file->getClientOriginalName();
                $file->move('images',$name);
                $utilisateur->photo = $name;
            }
        }
        // 3.text data
        $utilisateur->first_name = $request->input('first_name');
        $utilisateur->last_name = $request->input('last_name');
        $utilisateur->username = $request->input('username');
        $utilisateur->password = $request->input('password');

        $utilisateur->save();

        return response()->json($utilisateur);
    }

    public function show($id)
    {
        //give 1 user from users list
        $utilisateur = Utilisateur::find($id);
        return response()->json($utilisateur);

    }

    // public function edit($id)
    // {
    //     //
    // }

    public function update(Request $request, $id)
    {
        //Update user by ID
    }

    public function destroy($id)
    {
        //Delete user by ID
        $utilisateur = Utilisateur::find($id);
        $utilisateur->delete();
        return response()->json(`Utilisateur #$id supprimé avec succes !`);

    }
}
