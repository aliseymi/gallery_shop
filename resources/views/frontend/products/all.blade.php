@extends('layouts.frontend.master')

@section('style')
    <style>
        .hov-img0 img {
            height: 334px;
            object-fit: cover;
        }

    </style>
@endsection

@section('content')
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">

            @include('errors.message')

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="mtext-106 cl6 hov1 bor3 trans-04 m-l-32 m-tb-5 how-active1" data-filter="*">
                        همه دسته بندی ها
                    </button>

                    @foreach ($categories as $category)
                        <button class="mtext-106 cl6 hov1 bor3 trans-04 m-l-32 m-tb-5"
                            data-filter=".category{{ $category->id }}">
                            {{ $category->title }}
                        </button>
                    @endforeach

                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-l-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-l-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        فیلتر کردن
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 m-r-8 js-show-search">
                        <i class="icon-search cl2 m-l-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-l-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        جستجو
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <form class="flex-w p-l-15" action="{{ route('home.products.all') }}">
                            <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>

                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search"
                                placeholder="متن خود را اینجا بنویسید ...">
                        </form>
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">

                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                نوع محصول
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        رایگان
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        پولی
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                قیمت
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="/" class="filter-link stext-106 trans-04 @if (!request('range') || request()->fullUrl() == env('APP_URL')) filter-link-active @endif">
                                        همه
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=price&action=findByPriceRange&range=10to100000"
                                        class="filter-link stext-106 trans-04 {{ request('range') == '10to100000' ? 'filter-link-active' : '' }}">
                                        ۱۰ الی ۱۰۰ هزار تومان
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=price&action=findByPriceRange&range=101000to200000"
                                        class="filter-link stext-106 trans-04 {{ request('range') == '101000to200000' ? 'filter-link-active' : '' }}">
                                        ۱۰۱ الی ۲۰۰ هزار تومان
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=price&action=findByPriceRange&range=201000to300000"
                                        class="filter-link stext-106 trans-04 {{ request('range') == '201000to300000' ? 'filter-link-active' : '' }}">
                                        ۲۰۱ الی ۳۰۰ هزار تومان
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col3 p-r-15 p-b-27 mr-auto">
                            <div class="mtext-102 cl2 p-b-15">
                                مرتب سازی براساس
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="?filter=orderby&action=default"
                                        class="filter-link stext-106 trans-04 @if (request()->fullUrl() == env('APP_URL') || request('action') == 'default') filter-link-active @endif">
                                        پیش فرض
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=orderby&action=mostPopular"
                                        class="filter-link stext-106 trans-04 {{ request('action') == 'mostPopular' ? 'filter-link-active' : '' }}">
                                        محبوبیت
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=orderby&action=newest"
                                        class="filter-link stext-106 trans-04 {{ request('action') == 'newest' ? 'filter-link-active' : '' }}">
                                        جدیدترین
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=orderby&action=lowToHigh"
                                        class="filter-link stext-106 trans-04 {{ request('action') == 'lowToHigh' ? 'filter-link-active' : '' }}">
                                        قیمت:‌ کم به زیاد
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="?filter=orderby&action=highToLow"
                                        class="filter-link stext-106 trans-04 {{ request('action') == 'highToLow' ? 'filter-link-active' : '' }}">
                                        قیمت:‌زیاد به کم
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row isotope-grid">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item category{{ $product->category_id }}">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="/{{ $product->demo_url }}" alt="IMG-PRODUCT">

                                <a href="#" data-id="{{ $product->id }}"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quickSee">
                                    مشاهده سریع
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('home.products.show', $product->id) }}"
                                        class="mtext-106 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $product->title }}
                                    </a>

                                    <span class="stext-105 cl3">
                                        {{ number_format($product->price) }} تومان
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    مشاهده بیشتر
                </a>
            </div>
        </div>
    </div>


    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="quickSeeModal">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="/images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                {{-- <div class="wrap-slick3-dots"></div> --}}
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3" data-thumb="">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="" alt="IMG-PRODUCT"
                                                id="quickSeeMainImage" style="width: 513px; height: 460px; object-fit: cover;">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                id="expandImage" href="">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="/images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-02.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="/images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-03.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-l-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14" id="quickSee_title">
                                {{-- کارت ویزیت مشاور املاک --}}
                            </h4>

                            <span class="mtext-106 cl2" id="quickSee_price">
                                {{-- ۱۳ هزار تومان --}}
                            </span>

                            <p class="stext-102 cl3 p-t-23" id="quickSee_desc">
                                {{-- لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                                چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است --}}
                            </p>

                            <!--  -->
                            <div class="p-t-33">

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="flex-w flex-m respon6-next">
                                        <a href="" id="addToCart"
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            افزودن به سبد خرید
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $('.quickSee').click(function() {

            let id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('[name="csrf-token"]').content
                }
            });

            $.ajax({
                url: '/quickSee',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(res) {

                    $('#quickSee_title').html(res['title'])
                    $('#quickSee_price').html(res['price'])
                    $('#quickSee_desc').html(res['description'])
                    $('#addToCart').attr('href', res['href'])
                    $('#expandImage').attr('href', res['demo_url'])
                    $('#quickSeeMainImage').attr('src', res['demo_url'])

                }
            });

        });
    </script>

@endsection
