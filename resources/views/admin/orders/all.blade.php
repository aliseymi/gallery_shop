@extends('layouts.admin.master')

@section('style')
    <style>
        .product_img{
            width: 30px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 mt-4">
          <div class="col-12">
            <h1 class="m-0 text-dark">
                <a class="nav-link drawer" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                سفارشات</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">لیست سفارشات</h3>

                          <div class="card-tools">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                                  <div class="input-group-append">
                                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="table table-striped table-valign-middle mb-0">
                          <table class="table table-hover mb-0">
                              <tbody>
                              <tr>
                                  <th>کاربر</th>
                                  <th>مبلغ</th>
                                  <th>کد رهگیری</th>
                                  <th>وضعیت</th>
                                  <th>تاریخ</th>
                                  <th>مشاهده سفارش</th>
                              </tr>
                            
                              @foreach ($orders as $order)
                              <tr>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->price }} تومان</td>
                                <td>{{ $order->ref_code }}</td>
                                <td>
                                    @if ($order->status == 'paid')
                                    <span class="badge bg-success">موفق</span>
                                    @else
                                    <span class="badge bg-danger">ناموفق</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <button class="btn btn-default btn-icons seeCartDetails" data-id="{{ $order->id }}" data-toggle="modal" data-target="#order_items" title="مشاهده سبد خرید"><i class="fa fa-shopping-cart"></i></button>
                                </td>
                            </tr>
                              @endforeach

                              </tbody>
                          </table>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <div class="d-flex justify-content-center">
                      {{ $orders->links() }}
                  </div>
              </div>
          </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="order_items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">آیتم های سبد خرید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="table table-striped table-valign-middle mb-0">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>دسته بندی</th>
                                    {{-- <th>لینک دمو</th>
                                    <th>لینک دانلود</th> --}}
                                    <th>قیمت</th>
                                </tr>
                            </thead>

                            {{-- tbody fill by ajax --}}
                            <tbody id="orderTable"></tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                    <span>قیمت کل: <strong id="totalPrice"></strong></span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

@endsection


@section('script')

    <script>
        
        $('.seeCartDetails').on('click', function(){
            let id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : document.head.querySelector('[name="csrf-token"]').content,
                }
            });

            $.ajax({
                url: 'orders/details',
                type: 'POST',
                data: {
                    id: id 
                },
                success: function(res){
                    $('#orderTable').html(res['orderItemRows'])
                    $('#totalPrice').html(res['totalPrice'])
                }
            });
        });

    </script>

@endsection