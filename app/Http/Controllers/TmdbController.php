<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class TmdbController extends Controller
{
    public function getMovie($id_movie){
        try{
            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/movie/$id_movie?api_key=$key&language=es-ES");
            $json = json_decode($json, true);
            return response()->json($json);
        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error en la consulta de la pelicula'
            ]);
        }
    }

    public function getMoviePopular(){
        try{
            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=$key&language=es-ES");
            $json = json_decode($json, true);
            return response()->json($json);
        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error en la consulta de la pelicula'
            ]);
        }
    }

    public function putMovieReview(Request $request, $id_movie){
        try{
            $request->validate([
                'review' => 'required|string|max:450',
            ]);

            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/movie/$id_movie?api_key=$key&language=es-ES");
            $json = json_decode($json, true);

            $review = new Reviews;
            $review->review = $request->review;
            $review->users_id = Auth::user()->id;
            $review->id_movie_tv = $json['id'];
            $review->category = 'Movie';
            $review->save();

            return response()->json([
                    'success' => 'Reseña agregada a la pelicula.'
            ]);

        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error en la creación de la reseña.'
            ]);
        }
    }

    public function getMovieReviews($id_movie){
        try{
            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/movie/$id_movie?api_key=$key&language=es-ES");
            $json = json_decode($json, true);
            $reviews = Reviews::where([
                ['users_id', '=', Auth::user()->id],
                ['id_movie_tv', '=', $json['id']]
            ])->get();

            return $reviews->isEmpty() ? "No hay reviews para esta pelicula" : $reviews;

        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error al mostrar las reviews.'
            ]);
        }
    }


    public function getTvShow($id_tv_show){
        try{
            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/tv/$id_tv_show?api_key=$key&language=es-ES");
            $json = json_decode($json, true);
            return response()->json($json);
        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error en la consulta de la serie'
            ]);
        }
    }

    public function getTVShowPopular(){
        try{
            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/tv/popular?api_key=$key&language=es-ES");
            $json = json_decode($json, true);
            return response()->json($json);
        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error en la consulta de la serie'
            ]);
        }
    }


    public function putTvShowReview(Request $request, $id_tv_show){
        try{
            $request->validate([
                'review' => 'required|string|max:450',
            ]);

            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/tv/$id_tv_show?api_key=$key&language=es-ES");
            $json = json_decode($json, true);

            $review = new Reviews;
            $review->review = $request->review;
            $review->users_id = Auth::user()->id;
            $review->id_movie_tv = $json['id'];
            $review->category = 'Movie';
            $review->save();

            return response()->json([
                'success' => 'Reseña agregada a la serie.'
            ]);

        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error en la creación de la reseña.'
            ]);
        }
    }

    public function getTvShowReviews($id_tv_show){
        try{
            $key = env('TMDB_API_KEY');
            $json = file_get_contents("https://api.themoviedb.org/3/tv/$id_tv_show?api_key=$key&language=es-ES");
            $json = json_decode($json, true);
            $reviews = Reviews::where([
                ['users_id', '=', Auth::user()->id],
                ['id_movie_tv', '=', $json['id']]
            ])->get();
            return $reviews->isEmpty() ? "No hay reviews para esta serie" : $reviews;

        }catch (Throwable $e){
            return response()->json([
                'error' => 'Error al mostrar las reviews.'
            ]);
        }
    }

}
