<?php

namespace App\Http\Controllers;

use App\Grade;

class GradeController extends Controller
{
    /**
     * Return all grades 
     * 
     * @return User
     */
    public function showAll()
    {
        return response()->json(Grade::all());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du grade
     * @return Grade
     */
    public function showOne($id)
    {
        return response()->json(Grade::find($id));
    }
}
