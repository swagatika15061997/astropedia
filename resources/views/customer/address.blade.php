@extends('layouts.frontend.app')

@section('title','Address')

@push('css_or_js')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    img{
        display:inline !important;
    }
    .py-12{
        padding-top: 0rem !important;
    }
    .modal.show {
    background-color: rgb(3 29 46 / 1%) !important;
}
.modal-content {
    background-color: #e9ecef !important;
}
.modal .modal-dialog {
  display: block !important;
}
.fa-lg{
    padding: 4px;
    
}
.fa-trash{
    color:red;
}
.modal-body {
    margin-top: -51px !important;
}
</style>
@endpush
@section('content')
<section class="as_padderTop80 as_padderBottom80 page_margin" style="margin-top: 133px;">
    <div class="container">
        <h3 style="text-align: center;color:#000">Address</h3>
        <div class="row">
           @include('layouts.frontend.partial.side-bar')
           <div class="col-lg-4">
            <div class="card">   
              <div class="card-header d-flex justify-content-between">
                <div>
                   Shipping Address
                </div>
                @if($shipping)
                <div class="d-flex justify-content-between">
                    <a class="" title="Edit Address" id="edit" data-toggle="modal" data-target="#shipping" data-whatever="@mdo">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>
                    <a class="" title="Delete Address" href="{{route('delete_shipping_address',$shipping->id)}}" onclick="return confirm('Are you sure you want to Delete?');" id="delete">
                            <i class="fa fa-trash fa-lg"></i>
                    </a>
                </div>
                @endif
              </div>
              <div class="card-body">
                @if($shipping)
                <h5 class="card-title"><b>{{$shipping->contact_person_name}}</b></h5>
                <div class="card-text"><b>Phone:</b> {{$shipping->phone}}</div>
                <div class="card-text"><b>City:</b> {{$shipping->city}}</div>
                <div class="card-text"><b>Zip code:</b> {{$shipping->zip}}</div>
                <div class="card-text"><b>Address:</b> {{$shipping->address}}</div>
                <div class="card-text"><b>State:</b> {{$shipping->state}}</div>
                <div class="card-text"><b>Country:</b> {{$shipping->country}}</div>
                @else
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shipping" data-whatever="@mdo">Add Shipping Address</button>
                @endif
              </div>
            </div>        
           </div>
           <div class="col-lg-4">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div>
                   Billing Address
                </div>
                @if($billing)
                <div class="d-flex justify-content-between">
                    <a class="" title="Edit Address" id="edit" href="#" data-toggle="modal" data-target="#billing" data-whatever="@mdo">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>
                    <a class="" title="Delete Address" href="{{route('delete_billing_address',$billing->id)}}" onclick="return confirm('Are you sure you want to Delete?');" id="delete">
                            <i class="fa fa-trash fa-lg"></i>
                    </a>
                </div>
                @endif
              </div>
              <div class="card-body">
                @if($billing)
                <h5 class="card-title"><b>{{$billing->contact_person_name}}</b></h5>
                <div class="card-text"><b>Phone:</b> {{$billing->phone}}</div>
                <div class="card-text"><b>City:</b> {{$billing->city}}</div>
                <div class="card-text"><b>Zip code:</b> {{$billing->zip}}</div>
                <div class="card-text"><b>Address:</b> {{$billing->address}}</div>
                <div class="card-text"><b>State:</b> {{$billing->state}}</div>
                <div class="card-text"><b>Country:</b> {{$billing->country}}</div>
                @else
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#billing" data-whatever="@mdo">Add Billing Address</button>
                @endif
              </div>
            </div>        
           </div>
        </div> 
    </div>
</section>
@if($shipping)
<div class="modal fade" id="shipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('shipping_address_update',$shipping->id)}}">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Contact person name</label>
            <input type="text" class="form-control" id="recipient-name" name="contact_person_name" value="{{$shipping->contact_person_name}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone</label>
            <input type="text" class="form-control" id="recipient-name" name="phone" value="{{$shipping->phone}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">City</label>
            <input type="text" class="form-control" id="recipient-name" name="city" value="{{$shipping->city}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Zip code</label>
            <input type="text" class="form-control" id="recipient-name" name="zip" value="{{$shipping->zip}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">State</label>
            <input type="text" class="form-control" id="recipient-name" name="state" value="{{$shipping->state}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Country</label>
            <input type="text" class="form-control" id="recipient-name" name="country" value="{{$shipping->country}}">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <textarea class="form-control" id="message-text" name="address">{{$shipping->address}}</textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@else
<div class="modal fade" id="shipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('shipping_address_add')}}">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Contact person name</label>
            <input type="text" class="form-control" id="recipient-name" name="contact_person_name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone</label>
            <input type="text" class="form-control" id="recipient-name" name="phone">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">City</label>
            <input type="text" class="form-control" id="recipient-name" name="city">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Zip code</label>
            <input type="text" class="form-control" id="recipient-name" name="zip">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">State</label>
            <input type="text" class="form-control" id="recipient-name" name="state">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Country</label>
            <input type="text" class="form-control" id="recipient-name" name="country">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <textarea class="form-control" id="message-text" name="address"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endif
@if($billing)
<div class="modal fade" id="billing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Billing Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('billing_address_update',$billing->id)}}">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Contact person name</label>
            <input type="text" class="form-control" name="contact_person_name" value="{{$billing->contact_person_name}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone</label>
            <input type="text" class="form-control" id="recipient-name" name="phone" value="{{$billing->phone}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">City</label>
            <input type="text" class="form-control" id="recipient-name" name="city" value="{{$billing->city}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Zip code</label>
            <input type="text" class="form-control" id="recipient-name" name="zip" value="{{$billing->zip}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">State</label>
            <input type="text" class="form-control" id="recipient-name" name="state" value="{{$billing->state}}">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Country</label>
            <input type="text" class="form-control" id="recipient-name" name="country" value="{{$billing->country}}">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <textarea class="form-control" id="message-text" name="address">{{$billing->address}}</textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@else
<div class="modal fade" id="billing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Billing Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('billing_address_add')}}">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Contact person name</label>
            <input type="text" class="form-control" id="recipient-name" name="contact_person_name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone</label>
            <input type="text" class="form-control" id="recipient-name" name="phone">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">City</label>
            <input type="text" class="form-control" id="recipient-name" name="city">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Zip code</label>
            <input type="text" class="form-control" id="recipient-name" name="zip">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">State</label>
            <input type="text" class="form-control" id="recipient-name" name="state">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Country</label>
            <input type="text" class="form-control" id="recipient-name" name="country">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <textarea class="form-control" id="message-text" name="address"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endif
@endsection
@push('script')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script> -->
@endpush