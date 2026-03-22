<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>かけいぼアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="header">
            <div class="header__logo">
                <a href="{{ route('transaction.index') }}">かけいぼアプリ</a>
            </div>
            <div class="header__nav">
                <a href="{{ route('category.index')}}">カテゴリ編集</a>
            </div>
        </div>
    </header>
<div class="message">
    @if(session('success'))
    <p class="message__success">{{ session('success') }}</p>
    @endif
    @if(session('error'))
    <p class="message__error">{{ session('error') }}</p>
    @endif
    @foreach($errors->all() as $error)
    <p class="message__error">{{ $error }}</p>
    @endforeach
</div>
<main>
    @yield('content')
</main>
</body>

</html>