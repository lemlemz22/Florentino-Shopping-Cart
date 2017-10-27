@extends('layouts.app')

<style>
    .product_view .modal-dialog{max-width: 800px; width: 100%;}
    .pre-cost{text-decoration: line-through; color: #a5a5a5;}
    .space-ten{padding: 10px 0;}   
</style>

@section('content')
<div class="container">
    <div class="row">
        <?php $x=1; ?>
        @foreach ($products as $product)
        <div class="col-md-4">
          <div class="thumbnail">
            <img src="{{ $product -> path }}" alt="" class="img-responsive">
            <div class="caption">
              <h4 class="pull-right">{{ $product -> price }}.00 <i class="fa fa-btc" aria-hidden="true"></i> </h4>
              <h4><a href="#">{{ $product -> name }}</a></h4>
              <p>{{ $product -> description }}</p>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
            <div class="ratings">
              <p>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star-half-o"></span>
                 (15 reviews)
              </p>
            </div>
            <div class="space-ten"></div>
            <div class="btn-ground text-center">
                <form action="/home/add" method="POST" accept-charset="utf-8" style="display: inline;">
                    {{ csrf_field() }}
                    <input type="hidden" name="product_id" value="{{ $product -> id }}">
                    <input type="hidden" name="name" value="{{ $product -> name }}">
                    <input type="hidden" name="path" value="{{ $product -> path }}">
                    <input type="hidden" name="category_id" value="{{ $product -> category_id }}">
                    <input type="hidden" name="quantity" value="{{ $product -> quantity }}">
                    <input type="hidden" name="amount" value="{{ $product -> price }}">
                    <input type="hidden" name="barcode" value="{{ $product -> barcode }}">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add To Cart</button>
                </form>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#product_view{{ $x }}"><i class="fa fa-search"></i> Quick View</button>
            </div>
            <div class="space-ten"></div>
          </div>
        </div>
        <?php $x++; ?>
        @endforeach
    </div>
</div>
<?php $y=1; ?>
@foreach ($products as $product)
<div class="modal fade product_view" id="product_view{{ $y }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="fa fa-remove fa-lg"></span></a>
                <h3 class="modal-title">{{ $product -> name }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img" style="margin: 25px 0;">
                        <img src="{{ $product -> path }}" class="img-responsive" width="100%">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span>{{ $product -> barcode }}</span></h4>
                        <div class="rating">
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            (15 reviews)
                        </div><br>
                        <p> {{ $product -> description }} </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <h3 class="cost">{{ $product -> price }}.00 <span class="fa fa-btc"></span>&nbsp;&nbsp;<small class="pre-cost">60.00 <span class="fa fa-btc"></span></small></h3>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control" name="select">
                                    <option value="" selected="">Color</option>
                                    <option value="black">Black</option>
                                    <option value="white">White</option>
                                    <option value="gold">Gold</option>
                                    <option value="rose gold">Rose Gold</option>
                                </select>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control" name="select">
                                    <option value="">Storage</option>
                                    <option value="">16GB</option>
                                    <option value="">32GB</option>
                                    <option value="">64GB</option>
                                    <option value="">128GB</option>
                                </select>
                            </div>
                            <!-- end col -->
                            <div class="col-md-4 col-sm-12">
                                <select class="form-control" name="select">
                                    <option value="" selected="">Quantity</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                </select>
                            </div>
                            <!-- end col -->
                        </div>
                        <div class="space-ten"></div>
                        <div class="btn-ground" style="text-align: center">
                            <form action="/home/add" method="POST" accept-charset="utf-8" style="display: inline;">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{ $product -> id }}">
                                <input type="hidden" name="name" value="{{ $product -> name }}">
                                <input type="hidden" name="path" value="{{ $product -> path }}">
                                <input type="hidden" name="category_id" value="{{ $product -> category_id }}">
                                <input type="hidden" name="quantity" value="{{ $product -> quantity }}">
                                <input type="hidden" name="amount" value="{{ $product -> price }}">
                                <input type="hidden" name="barcode" value="{{ $product -> barcode }}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add To Cart</button>
                            </form>
                            <button type="button" class="btn btn-danger"><span class="fa fa-heart"></span> Add To Wishlist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $y++; ?>
@endforeach
@endsection
