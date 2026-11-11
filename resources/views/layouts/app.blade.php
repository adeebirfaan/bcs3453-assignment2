{{-- Main layout: shared page shell (head, top bar). Pages fill @yield('content'). --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Customer register built with Laravel: view all customers and filter them by gender or birthday.">
    <title>@yield('title', 'Customers') | Customer register</title>

    <link rel="preconnect" href="https://api.fontshare.com">
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@400,500,600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a class="skip" href="#main">Skip to the customer list</a>

    <header class="topbar">
        <div class="container topbar__inner">
            <a class="wordmark" href="{{ route('customers.index') }}" aria-label="Customer register, home">
                Customer register <span class="wordmark__course">BCS3453</span>
            </a>
            <span class="topbar__meta"><strong>Adeeb Irfaan</strong>, CB23061</span>
        </div>
    </header>

    <main id="main" class="container page">
        @yield('content')
    </main>
</body>
</html>
