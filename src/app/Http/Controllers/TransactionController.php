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
        // 年・月と収支で絞り込み
        $query = Transaction::query();
        if ($request -> month) {
            [$year,$month]=explode('-',$request->month);
            $query ->whereYear('date',$year)
                    ->whereMonth ('date',$month);
        }
        if ($request ->type){
            $query ->where ('type',$request->type);
        }
        $transactions = $query->orderBy('date', 'desc')->get();

        // 今月合計
        $thisMonth = now();
        $thisMonthTransactions = Transaction::query()
            ->whereYear('date', $thisMonth->year)
            ->whereMonth('date', $thisMonth->month)
            ->get();
        $totalIncome = $thisMonthTransactions->where('type', '収入')->sum('amount');
        $totalExpense = $thisMonthTransactions->where('type', '支出')->sum('amount');
        $categories = Category::all()->where('name', '!=', 'その他');

        // 先月合計
        $lastMonth = now()->subMonth();
        $lastQuery = Transaction::query()
            ->whereYear('date', $lastMonth->year)
            ->whereMonth('date', $lastMonth->month);
        $lastTransactions =$lastQuery ->get();
        $lastTotalIncome = $lastTransactions ->where('type','収入')->sum('amount');
        $lastTotalExpense = $lastTransactions->where('type', '支出')->sum('amount');

        return view('transactions.index',compact('transactions','categories','totalIncome','totalExpense', 'lastTotalIncome', 'lastTotalExpense'));
    }


    // 追加処理
    public function store(TransactionRequest $request)
    {
        $transaction = $request -> only ('category_id','amount','memo','date');
        $category = Category::find($request->category_id);
        $type = $category -> type;
        $transaction['type']=$type;
        Transaction::create($transaction);

        return redirect()->route('transaction.index')->with('success', '入出金に追加しました');

    }

    // 更新処理
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $data = $request->only('category_id', 'amount', 'memo', 'date');
        $category = Category::find($request->category_id);
        $data['type'] = $category->type;
        $transaction->update($data);

        return redirect()->route('transaction.index')->with('success','更新しました');
    }

    // 削除処理
    public function destroy(Transaction $transaction)
    {
        $transaction -> delete();

        return redirect()->route('transaction.index')->with('success', '削除しました');
    }
}
