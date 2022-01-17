@push('main')
    @include('navbar')
@endpush
@push('main')
    <main class="section" id="app">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <aside class="menu">
                        <p class="menu-label">@lang('menu.clients')</p>
                        <ul class="menu-list">
                            <li><a href="{{ route('products.indexClient') }}"><em class="pr-2 mdi mdi-map-legend"></em>Products</a></li>
                            <li><a href="{{ route('orders.index') }}"><em class="pr-2 mdi mdi-currency-usd"></em>Orders</a></li>
                        </ul>
                        <p class="menu-label">@lang('menu.system')</p>
                        <ul class="menu-list">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <em class="pr-2 mdi mdi-logout"></em>@lang('Logout')
                                </a>
                            </li>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </aside>
                </div>
                <div class="column is-four-fifths">
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <h1 class="title">{{ $texts['title'] }}</h1>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <div class="buttons">
                                    @foreach($buttons as $template => $button)
                                        @include("partials.buttons.$template", $button)
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @includeWhen(count($filters), 'filters', compact('filters'))
                    <div class="box block">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endpush
