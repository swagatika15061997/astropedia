@extends('layouts.frontend.app')

@section('title','wallet recharge')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
        <section class="as_breadcrum_wrapper">
            <div class="container">
                <div class="row">
                  <form method="POST" action="{{route('store-wallet-recharge')}}">
                    @csrf
                     <div class="mb-3">
                       <label for="exampleInputEmail1" class="form-label">Amount</label>
                       <input type="number" class="form-control" name="amount" id="exampleInputEmail1" aria-describedby="emailHelp">
                       @error('amount')<font color="red"></font>@enderror
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
                </div>
            </div>
        </section>
        
@endsection