@extends('layouts.frontend')

@section('content')

  <div class="home-index">

    <div class="container-fluid bg-primary text-center" style="background:linear-gradient(rgba(52, 73, 94, 0.45), rgba(52, 73, 94, 0.45)), url('/assets/img/bg/garbage.png') center; background-size: cover;">
      <br/><br/>
      <h3>{!! $home->data->banner->title !!}</h3>
      <h5 style="font-weight: normal;"><em>{!! $home->data->banner->description !!}</em></h5>
      <br/>

      <div class="row search-geo" style="margin-bottom:5px;">
        <div class="col-md-4 col-md-offset-4">
          <div class="input-group input-group-hg input-group-rounded">
            <span class="input-group-btn">
              <button class="btn" data-toggle="tooltip" data-placement="left" title="Auto-complete powered">
                <span class="fa fa-globe fa-lg"></span>
              </button>
            </span>
            <input class="form-control" placeholder="Province, town, city or region..."
              name="search-geo" id="search-geo">
          </div>
        </div>
      </div>


      <p><button class="btn btn-link" style="color:#fff;" id="search-my-geo"
        data-loading-text='<i class="fa fa-crosshairs fa-spin"></i> Locating you...'>
        <span class="fa fa-crosshairs"></span> Use my location
      </button></p>

      <p id="loading-geo" style="display:none;" >
        <i class="fa fa-crosshairs fa-spin"></i>
        Finding projects in this area...
      </p>

      <div class="alerts container text-left">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="alert alert-warning alert-dismissible" role="alert"
                style="padding: 10px 35px 10px 15px; display:none;" id="search-my-geo-alert">
              <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
              </button>
              <strong>Geolocation Failed</strong><br/>
              <small>Oops! It seems your are not in <em>{{ env('COUNTRY', 'South Africa') }}</em>. Try searching for a location instead.</small>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert"
                style="padding: 10px 35px 10px 15px; display:none;" id="search-my-geo-alert-denied">
              <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
              </button>
              <strong>Geolocation Failed</strong><br/>
              <small>
                It seems you haven't enabled <em>geolocation</em> in your browser. Fortunately you can fix this.<br/>
                <strong>Learn more:</strong> 
                  <a href="https://support.google.com/chrome/answer/142065?hl=en" target="_blank">Chrome</a> |
                  <a href="https://www.mozilla.org/en-US/firefox/geolocation/" target="_blank">Firefox</a>
              </small>
            </div>
          </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
      </div> <!-- /.alerts -->
            

      <br/><br/><br/>
    </div>

    <div class="container text-center" style="max-width: 800px;">
      <br/><br/>
      <h3>{!! $home->data->how->title !!}</h3><br/>
      <div class="row">
        <div class="col-sm-4">
          <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
          </span>
          {!! Markdown::convertToHtml($home->data->how->blurbs[0]->description) !!}
        </div>
        <div class="col-sm-4">
          <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-bolt fa-stack-1x fa-inverse"></i>
          </span>
          {!! Markdown::convertToHtml($home->data->how->blurbs[1]->description) !!}
        </div>
        <div class="col-sm-4">
          <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse"></i>
          </span>
          {!! Markdown::convertToHtml($home->data->how->blurbs[2]->description) !!}
        </div>
      </div> <!-- /.row -->
      <br/><br/>
    </div> <!-- /.container -->

    <div class="container-fluid text-right palette palette-turquoise"><br/><br/>
      <div class="container">
        <div class="row">
          <div class="col-sm-6 palette palette-turquoise text-center">
            <br/>
            <h1 style="font-size: 100px;">{{ number_format($projects_count) }}</h1>
            <p class="lead">
              @if( env('COUNTRY_CODE') == 'ng')
                Dumps in Benin
              @else
                EIAs tracked
              @endif
            </p>
            <div style="height:14px;"></div>
          </div> <!-- /.col-md-6 .bg-info -->
          <div class="col-sm-6">
            <div class="row">
              <div class="col-xs-6 palette palette-wet-asphalt">
                <br/>
                <p>Last Updated</p>
                <p><small><b>{{ $last_sync }}</b></small></p>
              </div>
              <div class="col-xs-6 palette palette-carrot">
                <br/>
                <p>Petitions</p>
                <p><small>Coming soon..</small><b></b></p>
              </div>
            </div><!-- /.row -->
            <div class="row">
              <div class="col-xs-6 palette palette-concrete">
                <br/>
                <p>Subscribers</p>
                <p><small>{{ $users_count }} subscribers</small><b></b></p>
              </div>
              <div class="col-xs-6 palette palette-alizarin">
                <br/>
                <p>Subscriptions</p>
                <p><small>{{ $subscriptions_count }} subscriptions</small><b></b></p>
              </div>
            </div> <!-- /.row -->
          </div> <!-- /.col-md-6 -->
        </div> <!-- /.row -->
      </div> <!-- /.container -->
      <br/><br/>
    </div> <!-- /.container-fluid -->

    <div class="container text-left">
      <br/><br/>

      @include('home.snippets.partners')

      <br/><br/>
    </div> <!-- /.container -->

  </div> <!-- /.home-index -->

@stop

@section('scripts')
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY', 'AIzaSyDWrLoGr3YIHkrFyzoSMsISNlvW4CKwifU') }}&libraries=places"></script>
  <script src="/assets/js/frontend/map-search.js"></script>
@stop
