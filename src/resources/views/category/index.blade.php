@extends('layouts.app')
@section('content')

<div class="category-content">
    <div class="category__create">
        <h2>カテゴリ追加</h2>
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <input type="text" name="name" placeholder="カテゴリ名">
            <select name="type" id="">
                <option value="収入">収入</option>
                <option value="支出">支出</option>
            </select>
            <button class="button__create" type="submit">作成</button>
        </form>
    </div>
    <div class="category__list">
        <div class="category__income-list">
            <h3>収入</h3>
            @foreach($typeIncomes as $typeIncome)
            <form action="{{ route('category.update', $typeIncome) }}" method="post">
                @csrf
                @method('PATCH')
                <div>
                    <input type="text" name="name" value="{{ $typeIncome->name }}">
                </div>
                <div>
                    <button type="submit">更新</button>
                </div>
            </form>
            <form action="{{ route('category.delete', $typeIncome) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
            @endforeach
        </div>
    </div>
    <div class="category__expense-list">
        <h3>支出</h3>
        @foreach($typeExpenses as $typeExpense)
        <form action="{{ route('category.update', $typeExpense) }}" method="post">
            @csrf
            @method('PATCH')
            <div>
                <input type="text" name="name" value="{{ $typeExpense->name }}">
            </div>
            <div>
                <button type="submit">更新</button>
            </div>
        </form>
        <form action="{{ route('category.delete', $typeExpense) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
        @endforeach
    </div>
</div>
@endsection