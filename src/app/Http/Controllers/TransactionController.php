<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    // 一覧表示と検索機能
    public function index(Request $request)
    {
        $query = Transaction::query();
        if ($request -> month) {
            [$year,$month]=explode('-',$request->month);
            $query ->whereYear('date',$year)
                    ->whereMonth ('date',$month);
        }
        if ($request ->type){
            $query ->where ('type',$request->type);
        }

        $transactions = $query ->get();
        $totalIncome = $transactions->where('type', '収入')->sum('amount');
        $totalExpense = $transactions->where('type', '支出')->sum('amount');
        $categories = Category::all();
        return view('transactions.index',compact('transactions','categories','totalIncome','totalExpense'));
    }


    // 追加処理
    public function store(Request $request)
    {
        $transaction = $request -> only ('category_id','amount','memo','date');
        $category = Category::find($request->category_id);
        $type = $category -> type;
        $transaction['type']=$type;
        Transaction::create($transaction);

        return redirect()->route('transaction.index');

    }

    // 更新処理
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->only('category_id', 'amount', 'memo', 'date');
        $category = Category::find($request->category_id);
        $data['type'] = $category->type;
        $transaction->update($data);

        return redirect()->route('transaction.index');
    }

    // 削除処理
    public function destroy(Transaction $transaction)
    {
        $transaction -> delete();

        return redirect()->route('transaction.index');
    }
}
