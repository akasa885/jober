<ul class="profileMoneyinfo">
  <li class="col-md-3 col-sm-6 col-xs-6 lrate">
    <div class="rating">
      {{__('My Ratings')}}
      <div class="star">
        <i class="fas fa-star" aria-hidden="true"></i>
        <i class="fas fa-star" aria-hidden="true"></i>
        <i class="fas fa-star" aria-hidden="true"></i>
        <i class="fas fa-star-half-alt" aria-hidden="true"></i>
        <i class="far fa-star" aria-hidden="true"></i>
      </div>
      <h6>{{__('3.5')}}</h6>
    </div>
  </li>
  <li class="col-md-3 col-sm-6 col-xs-6 rwallet">
    <div class="wallet">
      <i class="fas fa-wallet" aria-hidden="true"></i>
      {{__('My Wallet')}}
      <h6>{{__('Rp.')}}<a href="{{route('my.followings')}}">{{__('2,300,000')}}</a></h6>
    </div>
  </li>
</ul>
