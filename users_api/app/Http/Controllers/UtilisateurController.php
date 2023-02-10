<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;

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
            'email'=>'required',
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
        $utilisateur->email = $request->input('email');
        $utilisateur->password = Hash::make($request->input('password'));

        // 4.save and send api response
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
        $this->validate($request,[
            'photo'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $utilisateur = Utilisateur::find($id);


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
                $utilisateur->first_name = $request->input('first_name');
                $utilisateur->last_name = $request->input('last_name');
                $utilisateur->email = $request->input('email');
                $utilisateur->password = Hash::make($request->input('password'));
        
                $utilisateur->save();
        
                return response()->json($utilisateur);
    }

    public function destroy($id)
    {
        //Delete user by ID
        $utilisateur = Utilisateur::find($id);
        $utilisateur->delete();
        return response()->json(`Utilisateur #$id supprimé avec succes !`);

    }
}
