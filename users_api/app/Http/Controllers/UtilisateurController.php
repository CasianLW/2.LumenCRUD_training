<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;

class UtilisateurController extends Controller
{

    public function index()
    {
        // Get all data from db
        $utiisateurs = Utilisateur::all();
        return response()->json($utiisateurs);
    }



    public function store(Request $request)
    {
        //POST data to db from user (form)
    }

    public function show($id)
    {
        //give 1 user from users list
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

    }
}
