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
        $mentors = Mentor::all();
        foreach ($mentors as $mentor) {
            $mentor = $mentor->applicant->user;
        }
        return response()->json($mentors);
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du mentor
     * @return User
     */
    public function showOneMentor($id)
    {
        $mentor = Mentor::findOrFail($id);
        $mentor = $mentor->applicant->user;
        return response()->json($mentor);
    }
}
