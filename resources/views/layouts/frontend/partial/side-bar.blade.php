<style>
    .user-menu.active{
        background-color: #ffd600;
        border-color: #ffd600;
        font-weight: 600;
    }
    .list-group-flush>.list-group-item {
    border-width: 0 0 0px;
    font-weight: 600;
}
.side-icon{
  margin-right: 9px;
}
</style>
<div class="col-lg-3">
    <div class="card" style="padding:15px">
      <ul class="list-group list-group-flush">
        <li class="list-group-item user-menu {{Request::is('profile')?'active':''}}"><i class='fa fa-user-circle side-icon'></i><a href="{{route('profile.edit')}}">Profile Info</a></li>
        <li class="list-group-item user-menu {{Request::is('address')?'active':''}}"><i class="fa fa-address-card side-icon"></i><a href="{{route('address')}}">Address</a></li>
        <li class="list-group-item user-menu {{Request::is('order') || Request::is('order-details/*')?'active':''}}"><i class='fa fa-shopping-basket side-icon'></i><a href="{{route('order')}}">My Order</a></li>
        <li class="list-group-item user-menu {{Request::is('booking-list') ?'active':''}}"><i class="fa fa-list side-icon"></i><a href="{{route('booking-list')}}">Booking</a></li>
        <li class="list-group-item user-menu {{Request::is('wallet') ?'active':''}}"><i class="fa fa-wallet side-icon"></i><a href="{{route('wallet')}}">My Wallet</a></li>
        <li class="list-group-item user-menu {{Request::is('chat-history') ?'active':''}}"><i class="fa fa-comment side-icon"></i><a href="{{route('chat-history')}}">Chat History</a></li>
      </ul>
    </div>
</div>
