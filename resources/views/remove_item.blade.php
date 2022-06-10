@extends('layouts.main')

@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="flex-row col-md-6 offset-md-3">
                    <div class="section_title text-center">Your Cart - Ready to checkout?</div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="flex-row col-md-6 offset-md-3" style="margin-bottom: 35px;">
                    <div class="card" style="margin-bottom: 10px;border-radius: 15px; box-shadow: rgba(210,210,210,.1) 5px 5px 6px; border: rgba(0,0,0,.1) solid 1px;">
                        <div class="card-body">

                            <div class="row">
                                <div class="col col-md-5">
                                    <h4 class="text-center">{{ $products[0]->value }}</h4><hr>
                                    <img src="{{ asset('storage/products/'.$products[0]->img_dir) }}" class="img-responsive img-thumbnail" />
                                </div>
                                <div class="col col-md-7">
                                    <p class="">Are you sure you want to remove this item?</p><br>
                                    <form action="/cart/remove" method="post">
                                        @csrf
                                        <input type="hidden" name="cart_id" value="{{ $products[0]->id }}"/>
                                        <a href="/cart" class="btn btn-lg btn-light">cancel</a>
                                        <button type="submit" class="btn btn-lg btn-danger">remove</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javaScript')
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[id="checkbox"]').click(function(){
                $('input[type="checkbox"]').attr('checked',false);
            });
        });
    </script>
@endsection