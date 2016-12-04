@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3>Put in a Postal Code to find nearby restaurants</h3>
                </div>

                <div class="panel-body">
    <!-- Geolocation -->
     <form action="/geo" method="POST" class="form-horizontal" id="hiddenForm">
         {{ csrf_field() }}
         <!-- Postal code -->
         <div class="form-group">
            <label for="postal" class="col-sm-3 control-label">Postal Code</label>
            <div class="col-sm-6">
               <input type="text" name="postal" id="postal" class="form-control" value="{{ old('postal') }}">
            </div>
         </div>
         <!-- all the hidden fields -->
         <input type="hidden" name="latitude"/>
         <input type="hidden" name="longitude"/>
         <input type="hidden" name="error"/>
         <!-- submit Button -->
         <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
               <button type="submit" class="btn btn-default">
                   <i class="fa fa-btn fa-plus"></i>Submit
                </button>
            </div>
         </div>
     </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="/js/geo.js"></script>
@endsection