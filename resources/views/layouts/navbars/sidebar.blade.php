<div class="sidebar" data-color="orange">
    <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
    <div class="logo">
        <a href="{{url('')}}" class="simple-text logo-normal">
            {{ __('NeoFutsal') }}
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="@if ($activePage == 'home') active @endif">
                <a href="{{ route('home') }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#master-menu">
                    <i class="fas fa-list"></i>
                    <p>
                        {{ __("Master") }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if (@$parent == 'master') show @endif" id="master-menu">
                    <ul class="nav">
                        <li class="@if ($activePage == 'customer') active @endif">
                            <a href="{{route('admin.customer.index')}}">
                                <i class="now-ui-icons users_single-02"></i>
                                <p> {{ __("Pelanggan") }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'field') active @endif">
                            <a href="{{route('admin.field.index')}}">
                                <i class="fas fa-futbol"></i>
                                <p> {{ __("Lapangan") }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'ball') active @endif">
                            <a href="{{route('admin.ball.index')}}">
                                <i class="fas fa-futbol"></i>
                                <p> {{ __("Jenis Bola") }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'users') active @endif">
                            <a href="#">
                                <i class="fas fa-money-check"></i>
                                <p> {{ __("Metode Pembayaran") }} </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#order-menu">
                    <i class="fas fa-receipt"></i>
                    <p>
                        {{ __("Orderan") }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if (@$parent == " order") show @endif" id="order-menu">
                    <ul class="nav">
                        <li class="@if ($activePage == 'profile') active @endif">
                            <a href="#">
                                <i class="fas fa-receipt"></i>
                                <p> {{ __("Rekap Order") }} </p>
                            </a>
                        </li>
                        <li class="@if ($activePage == 'users') active @endif">
                            <a href="#">
                                <i class="fas fa-hand-holding-usd"></i>
                                <p> {{ __("Pendapatan") }} </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="@if ($activePage == 'setting') active @endif">
                <a href="#">
                    <i class="fas fa-cogs"></i>
                    <p>{{ __('Pengaturan') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
