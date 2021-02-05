<?php

namespace App\Http\Controllers;

use App\Applicant;

class ApplicantController extends Controller
{
    /**
     * Return all users 
     * 
     * @return User
     */
    public function showAll()
    {
        return response()->json(Applicant::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant de l'utilisateur
     * @return User
     */
    public function showOne($id)
    {
        return response()->json(Applicant::find($id));
    }
}
