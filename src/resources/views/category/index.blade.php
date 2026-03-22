@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}">
@endsection

@section('content')

<div class="category-content">
    <div class="category__create">
        <h2>カテゴリ追加</h2>
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <input class="category__create-name" type="text" name="name" placeholder="カテゴリ名">
            <select class="category__create-type" name="type" id="">
                <option value="収入">収入</option>
                <option value="支出">支出</option>
            </select>
            <button class="category__create-button" type="submit">作成</button>
        </form>
    </div>
    <div class="category__list">
        <div class="category__income-list">
            <h3>収入</h3>
            @foreach($typeIncomes as $typeIncome)
            <div class="category__item">
                <form action="{{ route('category.update', $typeIncome) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" value="{{ $typeIncome->name }}">
                    <button class="button__update" type="submit">更新</button>
                </form>
                <form action="{{ route('category.delete', $typeIncome) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="button__delete" type="submit">削除</button>
                </form>
            </div>
            @endforeach
        </div>
        <div class="category__expense-list">
        <h3>支出</h3>
        @foreach($typeExpenses as $typeExpense)
        <div class="category__item">
            <form action="{{ route('category.update', $typeExpense) }}" method="post">
                @csrf
                @method('PATCH')
                <input type="text" name="name" value="{{ $typeExpense->name }}">
                <button class="button__update" type="submit">更新</button>
            </form>
            <form action="{{ route('category.delete', $typeExpense) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="button__delete" type="submit">削除</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection