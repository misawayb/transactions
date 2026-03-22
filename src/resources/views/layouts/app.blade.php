<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>かけいぼアプリ</title>
</head>

<body>
    <header>
        <div class="header">
            <a class="header__logo" href="{{ route('transaction.index') }}">
                かけいぼアプリ
            </a>
            <div class="header__nav">
                <a href="{{ route('category.index')}}">カテゴリ編集</a>
            </div>
        </div>
    </header>
    <main>
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
        @yield('content')
    </main>
</body>

</html>