<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $project = $review->project; // ricavo l'informazione del progetto prima della cancellazione della review per poter tornare sulla pagina del progetto

        $review->delete();

        return redirect()->route('admin.projects.show', $project);
    }
}
