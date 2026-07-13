<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function getCategories(): JsonResponse
    {
        try {
            $categories = Category::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted categories successfully.',
                'data' => $categories
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Catagories Error : " . $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage()
            ], 500);
        }
    }


    public function createCategory(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        try {
            $categories = Category::create([
                'name' => $request->name
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Created catagory successfully.',
                'data' => $categories
            ], 201);
        } catch (\Exception $error) {
            Log::error("Create Catagory Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Create catagory failed. Please try again later.'
            ], 500);
        }
    }


    public function updateCategory(Request $request, $id): JsonResponse
    {
        $validate = $request->validate([
            'name' => 'required|string'
        ]);

        try {
            $category = Category::findOrFail($id);

            $category->update($validate);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated catagory successfully.',
                'data' => $category
            ], 200);
        } catch (\Exception $error) {
            Log::error("Update Catagory Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Update Catagory failed. Please try again later.'
            ], 500);
        }
    }


    public function deleteCategory($id): JsonResponse
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted (soft delete) successfully.'
            ], 200);
        } catch (\Exception $error) {
            Log::error("Delete Category Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Delete category failed. Please try again later.'
            ], 500);
        }
    }


    public function getRestoreCategory(): JsonResponse
    {
        try {
            $category = Category::onlyTrashed()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Geted category in trashed successfully.',
                'data' => $category
            ], 200);
        } catch (\Exception $error) {
            Log::error("Get Restore Category Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Could not fetch restore category failed. Please try again later.'
            ], 500);
        }
    }


    public function restoreCategory($id): JsonResponse
    {
        try {
            $category = Category::withTrashed()->findOrFail($id);

            $category->restore();

            return response()->json([
                'status' => 'success',
                'message' => "TheaterType 'id: $category->id' restored successfully."
            ], 200);
        } catch (\Exception $error) {
            Log::error("Restore Category Error : ", $error->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Restore category failed. Please try again later.'
            ], 500);
        }
    }
}
