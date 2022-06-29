<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <title>Home Page</title>
</head>
<body>
    <header>
        <nav class="md:flex md:justify-between md:items-center">
            <div class="mt-8 pl-10 pb-10">
                @guest
                    <a href="/register" class="text-xs font-bold uppercase">Register</a>
                @endguest
                
                <a href="#" 
                class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscire for Updates
                </a>
            </div>
        </nav>
    </header>

    <section>
        @if (session()->has('success'))
            <div x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4000)"
                x-show="show"
                class="fixed bottom-3 right-3 bg-blue-500 text-white text-sm py-2 px-4 rounded-xl"
            >
                <p>{{session('success')}}</p>
            </div>
        @endif
    </section>
</body>
</html>