{{--<div class="row">--}}
    {{--<div class="col col-md-9">--}}
        <form method="post" action="/account/update">
            @csrf
            <div class="form-group">
                <input name="name" value="{{ $users[0]->name }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <input name="surname" value="{{ $users[0]->surname }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <input name="email" value="{{ $users[0]->email }}" class="form-control" readonly required />
            </div>
            <div class="form-group">
                <input name="phone_number" value="{{ $users[0]->phone_number }}" class="form-control" required/>
            </div>
            <br>
            <h4>Your Shipping Address:</h4>
            <p><small><b>Important Note:</b><i>Your full address must be fill in to complete the purchase</i></small></p>
            <br>
            <div class="form-group">
                <input name="street_address" value="{{ isset($shipping)?$shipping[0]->street_address:'' }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <input name="suburb" value="{{ isset($shipping)?$shipping[0]->suburb:'' }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <input name="city" value="{{ isset($shipping)?$shipping[0]->city:'' }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <input name="province" value="{{ isset($shipping)?$shipping[0]->province:'' }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <input name="zip_code" value="{{ isset($shipping)?$shipping[0]->zip_code:'' }}" class="form-control" required/>
            </div>
            <div class="form-group">
                <button class="btn btn-success">Update</button>
            </div>
        </form>
    {{--</div>--}}
{{--</div>--}}