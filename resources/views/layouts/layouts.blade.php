<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ratans | Jual beli produk rotan</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/custom.css" type="text/css">
    @yield('css_before')
    @yield('css_after')
    @yield('js_before')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        seli.toyamilindo@gmail.com
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +62 896.2688.5802
                    </div>
                </div>
                <div class="ht-right">
                    @if(Auth::check())
                        <a href="/logout" class="login-panel"><i class="fa fa-sign-out "></i> logout</a>
                    @else
                        <a href="/login" class="login-panel"><i class="fa fa-user"></i>Login</a>
                    @endif
                    <!-- END User Dropdown -->
                    <!-- END User Dropdown -->
                    @if(Auth::check())
                        <a href="/profile" class="login-panel"> <i class="fa fa-cog"></i> {{ Auth::user()->name }} &nbsp; </a>
                    @endif
                    <!-- <div class="lan-selector">
                        <select class="language_drop" name="countries" id="countries" style="width:300px;">
                            <option value='yt' data-image="/img/flag-1.jpg" data-imagecss="flag yt"
                                data-title="English">English</option>
                            <option value='yu' data-image="/img/flag-2.jpg" data-imagecss="flag yu"
                                data-title="Bangladesh">German </option>
                        </select>
                    </div> -->
                    <div class="top-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                        <a href="#"><i class="ti-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="/">
                                <img src="/img/ratans/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <!-- <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li> -->
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{ count(Session::get('cartItems')) ?? '0' }}</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>

                                                @php
                                                    $total = 0 ;
                                                @endphp

                                                @if(isset($cartItems))
                                                    @foreach ($cartItems as $item)
                                                        <tr>
                                                            <td class="si-pic"><img src="{{ $item->associatedModel->image ?? '' }}" alt=""></td>
                                                            <td class="si-text">
                                                                <div class="product-selected">
                                                                    <p>{{ $item->price ?? '' }} x {{ $item->quantity ?? '' }}</p>
                                                                    <h6>{{ $item->name ?? ''}}</h6>
                                                                </div>
                                                            </td>
                                                            <td class="si-close">
                                                                <i class="ti-close"></i>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $harga = $item->price * $item->quantity;
                                                            $total = $total + $harga;
                                                        @endphp
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>Rp. {{ number_format($total ?? '','0') }}</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="/cart" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">Rp. {{ number_format($total ?? '','0') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All departments</span>
                        <ul class="depart-hover">
                            @php
                                $kategori_list = Session::get('kategori');
                            @endphp
                            @if(isset($kategori_list))
                                @foreach($kategori_list as $row)
                                    <li class="{{Request::segment(1) == $row->kategori ? 'active' : ''}}"><a href="#">{{ $row->kategori }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{Request::segment(1) == 'home' || Request::segment(1) == '' ? 'active' : ''}}"><a href="/">Home</a></li>
                        <li class="{{Request::segment(1) == 'shop' ? 'active' : ''}}"><a href="/shop">Shop</a></li>
                        <!-- <li class="{{ in_array(Request::segment(1),['setting-usdt','broker'])  ? 'open' : ''}}"><a href="#">Collection</a>
                            <ul class="dropdown">
                                @if(isset($kategori))
                                    @foreach ($kategori as $row)
                                        <li class="{{Request::segment(1) == $row->kategori ? 'active' : ''}}"><a href="#">{{ $row->kategori }}</a></li>
                                    @endforeach
                                @endif>
                            </ul>
                        </li> -->
                        <!-- <li><a href="./blog.html">Blog</a></li> -->
                        <li class="{{Request::segment(1) == 'contact' ? 'active' : ''}}"><a href="/contact">Contact</a></li>
                        <!-- <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="./blog-details.html">Blog Details</a></li>
                                <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                                <li><a href="./check-out.html">Checkout</a></li>
                                <li><a href="./faq.html">Faq</a></li>
                                <li><a href="/register">Register</a></li>
                                <li><a href="./login.html">Login</a></li>
                            </ul>
                        </li> -->
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="/img/ratans/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: {{ Session::get('office')->address ?? '' }}</li>
                            <li>Phone: {{ Session::get('office')->phone ?? '' }}</li>
                            <li>Email: {{ Session::get('office')->email ?? ''}}</li>
                        </ul>
                        <div class="footer-social">
                            <a href="{{ Session::get('office')->fb ?? '' }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ Session::get('office')->ig ?? '' }}"><i class="fa fa-instagram"></i></a>
                            <a href="{{ Session::get('office')->twitte ?? '' }}"><i class="fa fa-twitter"></i></a>
                            <!-- <a href="{{ Session::get('office')->tiktok ?? '' }}"><i class="fa fa-"></i></a> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SELI SUSANTI <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="/img/payment-method.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jquery.countdown.min.js"></script>
    <script src="/js/jquery.nice-select.min.js"></script>
    <script src="/js/jquery.zoom.min.js"></script>
    <script src="/js/jquery.dd.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>
    @yield('js_after')
</body>

</html>