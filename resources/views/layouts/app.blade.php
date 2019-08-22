<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('add_app_js')
    @yield('css')
</head>
<body>
    <div id="app">
       @include('assets.navigation')

        <main class="py-4">
          @auth
                <div class="container">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{session()->get('error')}}
                            </div>
                        @endif
                    <div class="row">
                        <div class="col-md-4">
                            <ul class="list-group">
                                @if(auth()->user()->isAdmin())
                                    <li class="list-group-item">
                                        <a href="{{route('users.index')}}">Users</a>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <a href="{{route('posts.index')}}">Posts</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('tags.index')}}">Tags</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{route('categories.index')}}">Categories</a>
                                </li>
                            </ul>
                            <ul class="list-group mt-5">
                                <li class="list-group-item">
                                    <a href="{{route('trashed')}}">Trashed Posts</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @else
                @yield('content')
            @endauth
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
