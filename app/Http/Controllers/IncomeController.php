<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    public function index(): JsonResponse
    {
        $incomes = Income::orderBy('date', 'desc')->get();
        return response()->json($incomes);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $income = Income::create($request->all());

        return response()->json($income, 201);
    }

    public function show($id): JsonResponse
    {
        $income = Income::findOrFail($id);
        return response()->json($income);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $income = Income::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $income->update($request->all());

        return response()->json($income);
    }

    public function destroy($id): JsonResponse
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return response()->json(null, 204);
    }
    
    public function summary(): JsonResponse
    {
        $total = Income::sum('amount');
        $monthly = Income::selectRaw('YEAR(date) as year, MONTH(date) as month, SUM(amount) as total')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
            
        return response()->json([
            'total' => $total,
            'monthly' => $monthly
        ]);
    }
}