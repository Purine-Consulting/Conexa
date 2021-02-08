<?php

namespace App\Http\Controllers;

use App\Mentee;
use Illuminate\Http\Request;

class MenteeController extends Controller
{
    /**
     * Return all mentees
     * 
     * @return mentee
     */
    public function showAllMentees()
    {
        $mentees = Mentee::all();
        foreach ($mentees as $mentee) {
            $mentee = $mentee->applicant->user;
        }
        return response()->json($mentees);
    }

    /**
     * Return one 
     * 
     * @param $id Identifiant du mentee
     * @return User
     */
    public function showOnementee($id)
    {
        $mentee = mentee::findOrFail($id);
        $mentee = $mentee->applicant->user;
        return response()->json($mentee);
    }

    public function update($id, Request $request)
    {
        $mentee = mentee::findOrFail($id);
        $mentee->update($request->all());
        return response()->json($mentee, 200);
    }

    public function delete($id)
    {
        mentee::findOrFail($id)->delete();
        return response('Supprimé avec succès!', 200);
    }
}
