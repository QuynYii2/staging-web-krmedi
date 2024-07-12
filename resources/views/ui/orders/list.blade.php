@extends('layouts.admin')
@section('title')
    {{ __('home.List Order') }}
@endsection
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .product-thumbnail {
        max-width: 100px;
        border: 1px solid #ccc;
        margin-right: 10px;
    }
    @media(min-width: 992px)
    {
    .col-lg-6 {
        width: 49.6%!important;
    }

    }
</style>
@section('main-content')
    <h3 class="text-center">{{ __('home.Order Management') }}</h3>
    <br>
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{route('view.web.orders.index')}}" method="get">
        <div class="card-body d-flex align-items-end flex-wrap p-0 pb-3">
            <div class="col-lg-3 col-md-6 col-12 px-1">
                <lable>Từ khóa</lable>
                <input type="text" class="form-control" name="key_search" placeholder="Tìm kiếm..." value="{{request()->get('key_search')}}">
            </div>
            <div class="col-lg-2 col-md-4 col-6 px-1">
                <lable>Trạng thái</lable>
                <select class="form-select w-100" name="status" >
                    <option class="bg-white" value="">--Trạng thái--</option>
                    <option class="bg-white" @if(request()->get('status') == 'ASSIGNING') selected @endif value="ASSIGNING">ASSIGNING</option>
                    <option class="bg-white" @if(request()->get('status') == 'ACCEPTED') selected @endif value="ACCEPTED">ACCEPTED</option>
                    <option class="bg-white" @if(request()->get('status') == 'IN PROCESS') selected @endif value="IN PROCESS">IN PROCESS</option>
                    <option class="bg-white" @if(request()->get('status') == 'COMPLETED') selected @endif value="COMPLETED">COMPLETED</option>
                    <option class="bg-white" @if(request()->get('status') == 'CANCELED') selected @endif value="CANCELED">CANCELED</option>
                    <option class="bg-white" @if(request()->get('status') == 'REFUND') selected @endif value="REFUND">REFUND</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-4 col-6 px-1">
                <lable>Thời gian khám</lable>
                <div class="position-relative">
                    <i class="bi bi-calendar4-week" style="position: absolute;top: 50%;transform: translateY(-50%);left: 10px"></i>
                    <input type="text" id="date_range" class="form-control" name="date_range" value="{{request()->get('date_range')}}" style="padding-left: 33px">
                </div>
            </div>
            <div class="col-md-4 col-12 px-0 mt-2">
                <button type="submit" class="btn btn-warning mx-2">Tìm kiếm</button>
                <a href="{{route('view.web.orders.index')}}" class="btn btn-dark">Làm mới</a>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-between flex-wrap">
        @foreach($orders as $key => $val)
            <div class="order-item p-2 border mt-2 col-lg-6 col-12">
                <div class="shop-info">
                    <b>Shop: </b> {{ $val->products->first()->username ?? '' }}
                </div>
                <div class="order-info">
                    @foreach($val->products as $index => $item)
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($item->thumbnail) }}" alt="" class="product-thumbnail">
                            <div class="product-info">
                                <div class="product-name">
                                    {{ $item->name }}
                                </div>
                                <div class="product-action d-flex align-items-center justify-content-between">
                                    <p class="quantity">
                                        x{{ $val->order_items[$index]->quantity ?? 0 }}
                                    </p>
                                    <p class="price">
                                        {{ number_format($item->price) }}
                                    </p>
                                </div>
                                <div class="product-name mb-3">
                                    Trạng thái đơn hàng: {{ $val->status }}
                                </div>
                                @if ($val->status == 'COMPLETED')
                                    <button data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$key}}" class="btn btn-danger">Hoàn đơn</button>
                                @endif
                                @if ($val->status == 'REFUND')
                                    @if ($val->type_order == 0)
                                        <div class="product-name mb-3" style="color: red">
                                            Hoàn hàng: chờ duyệt
                                        </div>
                                    @elseif ($val->type_order == 1)
                                        <div class="product-name mb-3" style="color: green">
                                            Hoàn hàng: đã duyệt
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if ($val->status == 'COMPLETED')
                            <div class="modal fade" id="staticBackdrop{{$key}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel{{$key}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel{{$key}}">Lý do hoàn đơn</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('restapi.api.orders.status', $val->id)}}" method="post" id="bookingHospitalForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <label style="font-size: 15px">Lý do hoàn đơn</label>
                                                <textarea name="reason_refund" class="w-100 mt-2" rows="3" required></textarea>
                                                <div class="row mt-3">
                                                    <div class="col-12">Hình ảnh :</div>
                                                    <div class="col-12">
                                                        <div class="form-control position-relative" style="padding-top: 50%">
                                                            <button type="button" class="position-absolute border-0 bg-transparent select-image" data-target="file{{$key}}" style="top: 50%;left: 50%;transform: translate(-50%,-50%)">
                                                                <i style="font-size: 30px" class="bi bi-download"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="file" name="file" id="file{{$key}}" accept="image/x-png,image/gif,image/jpeg" hidden>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">hủy</button>
                                                <button type="submit" class="btn btn-success">Hoàn đơn</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center align-items-center mt-3">
        {{ $orders->links() }}
    </div>
{{--    <div class="container">--}}
{{--        <ul class="nav nav-tabs justify-content-between" id="myTabOrder" role="tablist">--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link active" id="all_order_tab" data-bs-toggle="tab" data-bs-target="#all_order"--}}
{{--                        type="button" role="tab" aria-controls="all_order" aria-selected="true">--}}
{{--                    Tất cả đơn hàng--}}
{{--                </button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="process_order_tab" data-bs-toggle="tab" data-bs-target="#process_order"--}}
{{--                        type="button" role="tab" aria-controls="process_order" aria-selected="false">--}}
{{--                    Tìm tài xế--}}
{{--                </button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="wait_payment_order_tab" data-bs-toggle="tab"--}}
{{--                        data-bs-target="#wait_payment_order" type="button" role="tab" aria-controls="wait_payment_order"--}}
{{--                        aria-selected="false">--}}
{{--                    Đang chờ giao hàng--}}
{{--                </button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="ship_order_tab" data-bs-toggle="tab" data-bs-target="#ship_order"--}}
{{--                        type="button" role="tab" aria-controls="ship_order" aria-selected="false">--}}
{{--                    Đang giao hàng--}}
{{--                </button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="deliver_order_tab" data-bs-toggle="tab" data-bs-target="#deliver_order"--}}
{{--                        type="button" role="tab" aria-controls="deliver_order" aria-selected="false">--}}
{{--                    Đã giao hàng--}}
{{--                </button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="cancel_order_tab" data-bs-toggle="tab" data-bs-target="#cancel_order"--}}
{{--                        type="button" role="tab" aria-controls="cancel_order" aria-selected="false">--}}
{{--                    Đơn hàng hủy--}}
{{--                </button>--}}
{{--            </li>--}}
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link" id="refund_order_tab" data-bs-toggle="tab" data-bs-target="#refund_order"--}}
{{--                        type="button" role="tab" aria-controls="refund_order" aria-selected="false">--}}
{{--                    Đơn hàng hoàn--}}
{{--                </button>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content" id="myTabOrderContent">--}}
{{--            <div class="tab-pane fade show active" id="all_order" role="tabpanel" aria-labelledby="all_order_tab">--}}
{{--                <div class="list-order mt-3 list_all_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="process_order" role="tabpanel" aria-labelledby="process_order_tab">--}}
{{--                <div class="list-order mt-3 list_process_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="wait_payment_order" role="tabpanel" aria-labelledby="wait_payment_order_tab">--}}
{{--                <div class="list-order mt-3 list_wait_payment_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="ship_order" role="tabpanel" aria-labelledby="ship_order_tab">--}}
{{--                <div class="list-order mt-3 list_ship_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="deliver_order" role="tabpanel" aria-labelledby="deliver_order_tab">--}}
{{--                <div class="list-order mt-3 list_deliver_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="cancel_order" role="tabpanel" aria-labelledby="cancel_order_tab">--}}
{{--                <div class="list-order mt-3 list_cancel_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="refund_order" role="tabpanel" aria-labelledby="refund_order_tab">--}}
{{--                <div class="list-order mt-3 list_refund_order row justify-content-between">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="box-content-order"></div>--}}
{{--    </div>--}}
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
    <script>
        var pushers = new Pusher('3ac4f810445d089829e8', {
            cluster: 'ap1',
            encrypted: true
        });

        var channels = pushers.subscribe('aha-move-events');
        channels.bind('aha-move-events', function(data) {
            let currentUserId = "{{\Illuminate\Support\Facades\Auth::id()}}";
            if (data.user_id == currentUserId){
                function sendNotification(title, options) {
                    if (Notification.permission === "granted") {
                        new Notification(title, options);
                    }
                }
                function requestNotificationPermission() {
                    if (Notification.permission === "granted") {
                        sendNotification('Thông báo đã đơn hàng', { body: 'Trạng thái đơn hàng của bạn đã được thay đổi thành '+data.status });
                    } else if (Notification.permission !== "denied") {
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted") {
                                sendNotification('Thông báo đơn hàng', { body: 'Trạng thái đơn hàng của bạn đã được thay đổi thành '+data.status });
                            }
                        });
                    }
                }
                requestNotificationPermission();
                location.reload();
            }

            if (data.user_shop == currentUserId){
                function sendNotifications(title, options) {
                    if (Notification.permission === "granted") {
                        new Notification(title, options);
                    }
                }
                function requestNotificationPermissions() {
                    if (Notification.permission === "granted") {
                        sendNotifications('Thông báo đã đơn hàng', { body: 'Trạng thái đơn hàng của '+data.full_name+' đã được thay đổi thành '+data.status });
                    } else if (Notification.permission !== "denied") {
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted") {
                                sendNotifications('Thông báo đơn hàng', { body: 'Trạng thái đơn hàng của '+data.full_name+' đã được thay đổi thành '+data.status });
                            }
                        });
                    }
                }
                requestNotificationPermissions();
            }

        });

        // let accessToken = `Bearer ` + token;
        // let headers = {
        //     'Authorization': accessToken
        // };

        {{--$(document).ready(function () {--}}
        {{--    loadOrders('');--}}

        {{--    $('#all_order_tab').click(function () {--}}
        {{--        loadOrders('');--}}
        {{--    })--}}

        {{--    $('#process_order_tab').click(function () {--}}
        {{--        loadOrders('ASSIGNING');--}}
        {{--    })--}}

        {{--    $('#wait_payment_order_tab').click(function () {--}}
        {{--        loadOrders('ACCEPTED');--}}
        {{--    })--}}

        {{--    $('#ship_order_tab').click(function () {--}}
        {{--        loadOrders('IN PROCESS');--}}
        {{--    })--}}

        {{--    $('#deliver_order_tab').click(function () {--}}
        {{--        loadOrders('COMPLETED');--}}
        {{--    })--}}

        {{--    $('#cancel_order_tab').click(function () {--}}
        {{--        loadOrders('CANCELED');--}}
        {{--    })--}}

        {{--    $('#refund_order_tab').click(function () {--}}
        {{--        loadOrders('REFUND');--}}
        {{--    })--}}
        {{--})--}}

        {{--async function loadOrders(status) {--}}
        {{--    loadingMasterPage();--}}
        {{--    let orderUrl = `{{ route('restapi.api.orders.list.user', ['id'=>Auth::user()->id]) }}` + `?status=${status}`;--}}

        {{--    await $.ajax({--}}
        {{--        url: orderUrl,--}}
        {{--        method: 'GET',--}}
        {{--        headers: headers,--}}
        {{--        success: function (response) {--}}
        {{--            loadingMasterPage()--}}
        {{--            renderOrders(response, status);--}}
        {{--        },--}}
        {{--        error: function (error) {--}}
        {{--            loadingMasterPage()--}}
        {{--            console.log(error);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        {{--async function renderOrders(response, status) {--}}
        {{--    let html = ``;--}}
        {{--    let model = ``;--}}
        {{--    for (let i = 0; i < response.length; i++) {--}}
        {{--        let data = response[i];--}}
        {{--        let products = ``;--}}
        {{--        let username = ``;--}}
        {{--        let product_item = data.products;--}}
        {{--        let order_item = data.order_items;--}}
        {{--        if (product_item) {--}}
        {{--            for (let j = 0; j < product_item.length; j++) {--}}
        {{--                let formattedPrice = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product_item[j].price);--}}
        {{--                products = products + `<div class="d-flex align-items-center">--}}
        {{--                        <img src="${product_item[j].thumbnail}"--}}
        {{--                             alt="" class="product-thumbnail">--}}
        {{--                        <div class="product-info">--}}
        {{--                            <div class="product-name">--}}
        {{--                                ${product_item[j].name}--}}
        {{--                            </div>--}}
        {{--                            <div class="product-action d-flex align-items-center justify-content-between">--}}
        {{--                                <p class="quantity">--}}
        {{--                                    x${order_item[j].quantity}--}}
        {{--                                </p>--}}
        {{--                                <p class="price">--}}
        {{--                                     ${formattedPrice}--}}
        {{--                                </p>--}}
        {{--                            </div>--}}
        {{--                            ${status == ''?`<div class="product-name mb-3">--}}
        {{--                                Trạng thái đơn hàng: ${data.status}--}}
        {{--                            </div>`:``}--}}
        {{--                            ${data.status == 'COMPLETED'? `<button data-bs-toggle="modal" data-bs-target="#staticBackdrop${j}" class="btn btn-danger">Hoàn đơn</button>`:''}--}}
        {{--                            ${data.status == 'REFUND' && data.type_order == 0?`<div class="product-name mb-3" style="color: red">--}}
        {{--                                            Hoàn hàng: chờ duyệt--}}
        {{--                             </div>`:``}--}}
        {{--                            ${data.status == 'REFUND' && data.type_order == 1?`<div class="product-name mb-3" style="color: green">--}}
        {{--                                            Hoàn hàng: đã duyệt--}}
        {{--                             </div>`:``}--}}
        {{--                        </div>--}}
        {{--                    </div>`;--}}
        {{--                if (data.status == 'COMPLETED'){--}}
        {{--                    model += `<div class="modal fade" id="staticBackdrop${j}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel${j}" aria-hidden="true">--}}
        {{--                              <div class="modal-dialog">--}}
        {{--                                <div class="modal-content">--}}
        {{--                                  <div class="modal-header">--}}
        {{--                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Lý do hoàn đơn</h1>--}}
        {{--                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
        {{--                                  </div>--}}
        {{--                                    <form action="${window.location.origin}/orders/status/${data.id}" method="post" id="bookingHospitalForm" enctype="multipart/form-data">--}}
        {{--                                    @csrf--}}
        {{--                                  <div class="modal-body">--}}
        {{--                                        <lable style="font-size: 15px">Lý do hoàn đơn</lable>--}}
        {{--                                        <textarea name="reason_refund" class="w-100 mt-2" rows="3" required></textarea>--}}
        {{--                                         <div class="row mt-3">--}}
        {{--                                            <div class="col-12">Hình ảnh :</div>--}}
        {{--                                            <div class="col-12">--}}
        {{--                                                <div class="form-control position-relative" style="padding-top: 50%">--}}
        {{--                                                    <button type="button" class="position-absolute border-0 bg-transparent select-image" data-target="file${j}" style="top: 50%;left: 50%;transform: translate(-50%,-50%)">--}}
        {{--                                                        <i style="font-size: 30px" class="bi bi-download"></i>--}}
        {{--                                                    </button>--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                        <input type="file" name="file" id="file${j}" accept="image/x-png,image/gif,image/jpeg" hidden>--}}
        {{--                                  </div>--}}
        {{--                                  <div class="modal-footer">--}}
        {{--                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">hủy</button>--}}
        {{--                                    <button type="submit" class="btn btn-success">Hoàn đơn</button>--}}
        {{--                                  </div>--}}
        {{--                                   </form>--}}
        {{--                                </div>--}}
        {{--                              </div>--}}
        {{--                            </div>`--}}
        {{--                }--}}
        {{--            }--}}

        {{--            username = `<b>${product_item[0].username}</b>`;--}}
        {{--        }--}}

        {{--        html = html + `<div class="order-item p-2 border mt-2 col-lg-6 col-12">--}}
        {{--                 <div class="shop-info">--}}
        {{--                    <b>Shop: </b> ${username}--}}
        {{--                </div>--}}
        {{--                <div class="order-info">--}}
        {{--                    ${products}--}}
        {{--                </div>--}}
        {{--            </div>`;--}}
        {{--    }--}}

        {{--    switch (status) {--}}
        {{--        case 'ASSIGNING':--}}
        {{--            $('.list_process_order').empty().append(html);--}}
        {{--            break;--}}
        {{--        case 'ACCEPTED':--}}
        {{--            $('.list_wait_payment_order').empty().append(html);--}}
        {{--            break;--}}
        {{--        case 'IN PROCESS':--}}
        {{--            $('.list_ship_order').empty().append(html);--}}
        {{--            break;--}}
        {{--        case 'COMPLETED':--}}
        {{--            $('.list_deliver_order').empty().append(html);--}}
        {{--            break;--}}
        {{--        case 'CANCELED':--}}
        {{--            $('.list_cancel_order').empty().append(html);--}}
        {{--            break;--}}
        {{--        case 'REFUND':--}}
        {{--            $('.list_refund_order').empty().append(html);--}}
        {{--            break;--}}
        {{--        default:--}}
        {{--            $('.list_all_order').empty().append(html);--}}
        {{--            break;--}}
        {{--    }--}}
        {{--    $('.box-content-order').empty().append(model);--}}
        {{--}--}}

        function confirmCancelOrder(id) {
            if (confirm('Are you sure you want to cancel!')) {
                cancelOrder(id);
            }
        }

        async function cancelOrder(id) {
            let orderCancelUrl = ``;
            orderCancelUrl = orderCancelUrl.replace(':id', id);

            await $.ajax({
                url: orderCancelUrl,
                method: 'DELETE',
                headers: headers,
                success: function (response) {
                    alert('Cancel success!');
                    window.location.reload();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        let parent;
        $(document).on("click", ".select-image", function () {
            let target = $(this).data('target');
            $('#'+target ).click();
            parent = $(this).parent();
            $('#'+target).change(function(e){
                imgPreview(this);
            });
        });

        function imgPreview(input) {
            let file = input.files[0];
            let mixedfile = file['type'].split("/");
            let filetype = mixedfile[0];
            if(filetype == "image"){
                let reader = new FileReader();
                reader.onload = function(e){
                    $("#preview-img").show().attr("src", );
                    let html = '<div class="position-absolute w-100 h-100 div-file" style="top: 0; left: 0;z-index: 10">' +
                        '<button type="button" class="position-absolute clear border-0 bg-danger p-0 d-flex justify-content-center align-items-center" style="top: -10px;right: -10px;width: 30px;height: 30px;border-radius: 50%"><i class="bi bi-x-lg text-white"></i></button>'+
                        '<img src="'+e.target.result+'" class="w-100 h-100" style="object-fit: cover">' +
                        '</div>';
                    parent.html(html);
                }
                reader.readAsDataURL(input.files[0]);
            }else {
                alert("Invalid file type");
            }
        }
        $(document).on("click", "button.clear", function () {
            $(".div-file").remove();
            let html = '<button type="button" class="position-absolute border-0 bg-transparent select-image" style="top: 50%;left: 50%;transform: translate(-50%,-50%)">\n' +
                '                                    <i style="font-size: 30px" class="bi bi-download"></i>\n' +
                '                                </button>';
            parent.html(html);
            $('input[type="file"]').val("");
        });
        $(function() {
            $('#date_range').on('focus', function() {
                $('#date_range').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD',
                        applyLabel: "Apply",
                        cancelLabel: "Cancel",
                        customRangeLabel: "Custom Range"
                    },
                    ranges: {
                        'Hôm nay': [moment(), moment()],
                        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 Ngày trước': [moment().subtract(6, 'days'), moment()],
                        '30 Ngày trước': [moment().subtract(29, 'days'), moment()],
                        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left'
                });
            });
        });
    </script>
@endsection
