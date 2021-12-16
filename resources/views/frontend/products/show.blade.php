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

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-t-30">
            <a href="{{ route('home.products.all') }}" class="mtext-106 cl8 hov-cl1 trans-04">
                خانه
                <i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            {{-- <a href="product.html" class="mtext-106 cl8 hov-cl1 trans-04">
                {{ $product->category->title }}
                <i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
            </a> --}}

            <span class="mtext-106 cl8">
				{{ $product->category->title }}
                <i class="fa fa-angle-left m-l-9 m-r-10" aria-hidden="true"></i>
			</span>

            <span class="mtext-106 cl4">
				{{ $product->title }}
			</span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-l-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="/{{ $product->demo_url }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="/{{ $product->demo_url }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="/{{ $product->demo_url }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                {{-- <div class="item-slick3" data-thumb="/images/product-detail-02.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="/images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="/images/product-detail-03.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="/images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->title }}
                        </h4>

                        <span class="mtext-106 cl2">
							 {{ number_format($product->price) }} تومان
						</span>

                        <p class="stext-102 cl3 p-t-23">
                            {!! $product->description !!}
                        </p>

                        <!--  -->
                        <div class="p-t-33">

                            <div class="flex-w flex-r-m p-b-10">
                                <div class="flex-w flex-m respon6-next">
                                    <a href="{{ route('home.cart.add', $product->id) }}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        افزودن به سبد خرید
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">توضیحات</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">مشخصات فایل</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="mtext-106 cl6" style="line-height: 40px">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        <li class="flex-w flex-t p-b-7">
											<span class="mtext-106 cl3 size-205">
												صاحب طرح
											</span>

                                            <span class="mtext-106 size-206">
												{{ $product->owner->name }}
											</span>
                                        </li>

                                        <li class="flex-w flex-t p-b-7">
											<span class="mtext-106 cl3 size-205">
												تاریخ ایجاد
											</span>

                                            <span class="mtext-106 cl6 size-206">
												{{ $product->created_at }}
											</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    طرح های مشابه
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">

                    @foreach ($similarProducts as $similarProduct)
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="/{{ $similarProduct->demo_url }}" alt="IMG-PRODUCT">

                                <a href="#" data-id="{{ $similarProduct->id }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quickSee">
                                    مشاهده سریع
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('home.products.show', $similarProduct->id) }}" class="mtext-106 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $similarProduct->title }}
                                    </a>

                                    <span class="stext-105 cl3">
									{{ number_format($similarProduct->price) }} تومان
								</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

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
                $('#expandImage').attr('href', '/' + res['demo_url'])
                $('#quickSeeMainImage').attr('src', '/' + res['demo_url'])

            }
        });

    });
</script>

@endsection