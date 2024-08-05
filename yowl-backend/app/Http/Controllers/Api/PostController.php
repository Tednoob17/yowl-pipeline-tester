<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function postcreation(PostCreateRequest $request): JsonResponse
    {
       
            if (Auth::guest()) {
                return $this->handleResponse("Unauthorized to create a post",  "You need to be logged before to create a pos", Response::HTTP_FORBIDDEN);
            }else{
                $post = Post::create([
                    'link' => $request->link,
                    'panda' => $request->panda,
                ]);

                return $this->handleResponse($post, "User succesfully created");
            } 
        }
        
        protected function failedValidation(Validator $validator)
        {
            throw new HttpResponseException(
                response()->json($validator->errors(), 422)
            );
        }
    }

