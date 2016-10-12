<div class="js-cookie-consent cookie-consent alert alert-info">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}
    </span>

   <div class="pull-right">
       <a href="#" class="btn btn-danger btn-xs" data-dismiss="alert" aria-label="close">Deny</a>

       <button class="js-cookie-consent-agree cookie-consent__agree btn btn-info btn-xs">
           {{ trans('cookieConsent::texts.agree') }}
       </button>
   </div>

</div>
