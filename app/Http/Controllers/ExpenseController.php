<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            $expenses = Expense::all();
            return response()->json([
                "message" => "expenses retrieved successfully",
                "expenses" => $expenses
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "retrieved all expenses wrong", $e->getMessage()],500);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $expense = Expense::create($request->all());
            return response()->json([
                "message" => "expenses retrieved successfully",
                "expenses" => $expense
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "store  expense wrong", $e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try{
            $expense = Expense::findOrFail($id);
            return response()->json([
                "message" => "expense retrieved successfully",
                "expenses" => $expense
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "expense retrieved by id wrong", $e->getMessage()],500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, $id)
    {
        //
        try{
            $expense = Expense::findOrFail($id);
            $expense->update($request->all());
            return response()->json([
                "message" => "expenses updated successfully",
                "expenses" => $expense
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "update  expense wrong", $e->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try{
            $expense = Expense::findOrFail($id);
            $expense->delete();
            return response()->json([
                "message" => "expense deleted successfully",
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "update  expense wrong", $e->getMessage()],500);
        }
    }
}
