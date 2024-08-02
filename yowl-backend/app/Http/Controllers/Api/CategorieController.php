<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorie = Categorie::paginate(10);

        return $this->handleResponse($categorie, "List of all categories");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $categorie = Categorie::create($request->all());
            return $this->handleResponse($categorie, "Category created successfully");
        }
        catch (\Exception $e)
        {
            return $this->handleResponse($e->getMessage(), "An error occurred", false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($categorie)
    {
        try
        {
            $categorie = Categorie::findOrFail($categorie);
            return $this->handleResponse($categorie, "Category found");
        }
        catch (\Exception $e)
        {
            return $this->handleResponse($e->getMessage(), "Category not found", 404, false);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categorie)
    {
        try
        {
            $categorie = Categorie::findOrFail($categorie);
            $categorie->update($request->all());
            return $this->handleResponse($categorie, "Category updated successfully");
        }
        catch (\Exception $e)
        {
            return $this->handleResponse($e->getMessage(), "An error occurred", 404, false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categorie)
    {
        try
        {
            $categorie = Categorie::findOrFail($categorie);
            $categorie->delete();
            return $this->handleResponse($categorie, "Category deleted successfully");
        }
        catch (\Exception $e)
        {
            return $this->handleResponse($e->getMessage(), "An error occurred", 404, false);
        }
    }
}
