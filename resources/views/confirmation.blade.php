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
      {{--<form method="POST" action="https://sandbox.payfast.co.za/eng/process">--}}
      <form method="POST" action="https://www.payfast.co.za/eng/process">
        {{--@csrf--}}
        {{--<div class="row">
          <div class="flex-row col-md-8 offset-md-2">
            <a href="/cart" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit">Proceed</button>
          </div>
        </div>--}}
        <div class="row">
          <div class="flex-row col-md-5 offset-md-1">
            <div class="">
              <div class="card primary-border">
                <div class="card-header primary-border primary-background"><h4 class=" text-center text-white">Shipping Details</h4></div>
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <td align="right"><b>Name:</b></td><td ><u>{{ $userData->name }}</u></td>
                      <td align="right"><b>Surname:</b></td><td><u>{{ $userData->surname }}</u></td>
                    </tr>
                    <tr><td align="right"><b>Street Address:</b></td><td colspan="3"><u>{{ $userData->street_address }}</u></td></tr>
                    <tr><td align="right"></td><td colspan="3"><u>{{ $userData->suburb }}</u></td></tr>
                    <tr><td align="right"></td><td colspan="3"><u>{{ $userData->city }}</u></td></tr>
                    <tr><td align="right"><b>Province</b></td><td colspan="3"><u>{{ $userData->province }}</u></td></tr>
                    <tr><td align="right"><b>Postal Code:</b></td><td colspan="3"><u>{{ $userData->zip_code }}</u></td></tr>
                    <tr><td align="right" colspan="4"><a class="btn btn-light" href="/account">edit address</a></td></tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="flex-row col-md-5">
            <div class="product">
              <div class="card primary-border">
                <div class="card-header primary-background"><h4 class="text-white">Your checkout details</h4></div>
                <div class="card-body">
                  <table class="table border-0">
                      <?php $cnt=1; ?>
                    <thead><th></th><th>Products</th><th>Price</th></thead>
                    <tbody>
                      @foreach($ProductsList as $prod)
                          <tr><td><?php echo $cnt; ?></td><td>{{ $prod['name'] }}</td><td>R{{ $prod['price'] }}</td></tr>
                          <?php $cnt++; ?>
                      @endforeach
                      <tr><td colspan="2" align="right"><b> Deliver fee</b></td><td><b>R{{ $Delivery }}</b></td></tr>
                      <tr><td></td><td align="right"><b>Total Due</b></td><td><b>R{{ $Total }}</b></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="btn-group pull-right">
              <a href="/cart" class="btn btn-light">Back</a>
              <button class="btn btn-primary" type="submit">Proceed to Payment</button>
            </div>
          </div>
        </div>
        {{--<input type="hidden" name="merchant_id" value="10012783">--}}
        {{--<input type="hidden" name="merchant_key" value="ononmsga859lg">--}}
        <input type="hidden" name="merchant_id" value="25066245">
        <input type="hidden" name="merchant_key" value="cehvqo4vppf4q">
        <input type="hidden" name="name_first" value="{{ Auth::user()->name }}">
        <input type="hidden" name="name_last" value="{{ Auth::user()->surname }}">
        <input type="hidden" name="email_address" value="{{ Auth::user()->email }}">

        <input type="hidden" name="m_payment_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="amount" value="{{ $Total }}">
        <input type="hidden" name="item_name" value="Ganic Roots Purchase Order">

        <input type="hidden" name="return_url" value="http://www.ganicroots.co.za/payment/success">
        <input type="hidden" name="cancel_url" value="http://www.ganicroots.co.za/payment/cancel">
        {{--<input type="hidden" name="notify_url" value="http://www.ganicroots.co.za/payment/notify">--}}
        <input type="hidden" name="notify_url" value="https://www.ganicroots.co.za/payfast_results.php">
      </form>
    </div>

    <div class="container">
      <div class="row">
        <div class="flex-row col-md-8 offset-md-2">
          <h4 class="pt-5">
            Please note the following when you make an order:
          </h4>
          <div class="alert alert-info">
            <ol style="font-style: italic;">
              <li>All orders are sent via door-to-door courier service and our general shipping timeline is between 3 to 5 working days.</li>
              <li>Should there be any exceptions to the above we will contact you to make alternative arrangements.</li>
              <li>Unfortunately Ganic Roots does not offer deliveries outside the borders of South Africa at this time. </li>
              <li>Due to Covid-19 and the hygienic nature of our products, there will be no exchanges or returns. However,
                if you are unsatisfied with your order in any way, please contact us with 7 days and we will do our best to help you.
                For more enquiries please send us an email at <b>info@ganicroots.co.za</b>
              </li>
            </ol>
          </div>
        </div>
        <div class="flex-row col-md-4 offset-md-6">
          <ul style="padding-bottom: 50px; font-style: italic; list-style: none; text-align: right;">
            {{--<li><img src="{{ asset('/img/FastWay.png') }}" style="max-width:120px;margin-right:15px;background-color: #012169; float:right;" class="img-responsive" /></li>--}}
            <li><img src="{{ asset('/img/PayFast.png') }}" style="max-width:120px;padding-right:5px;float:right;" class="img-responsive" /></li>
          </ul>
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
