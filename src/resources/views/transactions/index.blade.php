@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/transactions.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content__top">
        {{-- 今月の集計 --}}
        <div class="this-month">
            <h2>今月</h2>
            <table>
                <tr>
                    <th>収入</th>
                    <td>{{ $totalIncome }}</td>
                </tr>
                <tr>
                    <th>支出</th>
                    <td>{{ $totalExpense }}</td>
                </tr>
                <tr>
                    <th>収支</th>
                    <td>{{ $totalIncome - $totalExpense }}</td>
                </tr>
            </table>
        </div>
        {{-- 先月の集計 --}}
        <div class="last-month">
            <h2>先月</h2>
            <table>
                <tr>
                    <th>収入</th>
                    <td>{{ $lastTotalIncome }}</td>
                </tr>
                <tr>
                    <th>支出</th>
                    <td>{{ $lastTotalExpense }}</td>
                </tr>
                <tr>
                    <th>収支</th>
                    <td>{{ $lastTotalIncome - $lastTotalExpense }}</td>
                </tr>
            </table>
        </div>
        <!--
        {{-- 検索フォーム --}}
        <div class="search">
            <h2>検索</h2>
            <form action="{{ route('transaction.index') }}" method="get">
                <input type="month" name="month">
                <select name="type">
                    <option value="">すべて</option>
                    <option value="収入">収入</option>
                    <option value="支出">支出</option>
                </select>
                <button type="submit">検索</button>
            </form>
        </div>
    -->
    </div>
    {{-- 収支追加フォーム --}}
    <div class="add__transactions">
        <h2>収支追加</h2>
        <form action="{{ route('transaction.store') }}" method="post">
            @csrf
            <input type="date" name="date">
            <select name="type">
                <option value="収入">収入</option>
                <option value="支出">支出</option>
            </select>
            <select name="category_id">
                <option value="カテゴリ名">--カテゴリ--</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input class="add__transactions-amount" type="number" name="amount" placeholder="金額">
            <input class="add__transactions-memo" type="text" name="memo" placeholder="メモ（任意：20文字以下）">
            <button type="submit">作成</button>
        </form>
    </div>

    {{-- 収支一覧 --}}
    <div class="content__index">
        <h2>入出金一覧</h2>
        @foreach($transactions as $transaction)
        <form action="{{ route('transaction.update', $transaction) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="transaction-row">
                <div><input type="date" name="date" value="{{ $transaction->date }}"></div>
                <div>
                    <select name="type">
                        <option value="収入" {{ $transaction->type == '収入' ? 'selected' : '' }}>収入</option>
                        <option value="支出" {{ $transaction->type == '支出' ? 'selected' : '' }}>支出</option>
                    </select>
                </div>
                <div>
                    <select name="category_id">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $transaction->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="number" name="amount" value="{{ $transaction->amount }}">
                </div>
                <div>
                    <input type="text" name="memo" value="{{ $transaction->memo }}">
                </div>
                <div>
                    <button class="button__update" type="submit">更新</button>
                </div>
        </form>
        <form action="{{ route('transaction.delete', $transaction) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="button__delete" type="submit">削除</button>
        </form>
    </div>
    @endforeach
</div>

</div>
@endsection