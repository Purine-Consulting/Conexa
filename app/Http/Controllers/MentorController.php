<?php

namespace App\Http\Controllers;

use App\Mentor;

class MentorController extends Controller
{
    /**
     * Return all mentors
     * 
     * @return Mentor
     */
    public function showAllMentors()
    {
        return response()->json(Mentor::all()->applicant()->user());
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du mentor
     * @return User
     */
    public function showOneMentor($id)
    {
        return response()->json(Mentor::find($id)->applicant()->user());
    }
}
