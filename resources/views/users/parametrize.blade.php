@extends('layouts.master')

@section('content')

 <!-- Page Heading -->
 <h1 class="my-4">@lang('layout.title')
    <small>@lang('user.parametrize')</small>
</h1>

<p>@lang('user.explanation')</p>
<form method="POST" action="/users/parametrize">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">@lang('user.parameter')</th>
          <th scope="col">@lang('user.-5')</th>
          <th scope="col">@lang('user.-4')</th>
          <th scope="col">@lang('user.-3')</th>
          <th scope="col">@lang('user.-2')</th>
          <th scope="col">@lang('user.-1')</th>
          <th scope="col">@lang('user.0')</th>
          <th scope="col">@lang('user.1')</th>
          <th scope="col">@lang('user.2')</th>
          <th scope="col">@lang('user.3')</th>
          <th scope="col">@lang('user.4')</th>
          <th scope="col">@lang('user.5')</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>@lang('user.temp40')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp40', -2) == $i)
              <input type="radio" name="temp40" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp40" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp30')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp30', 2) == $i)
              <input type="radio" name="temp30" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp30" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp20')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp20', 1) == $i)
              <input type="radio" name="temp20" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp20" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp10')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp10', 0) == $i)
              <input type="radio" name="temp10" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp10" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp0')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp0', 0) == $i)
              <input type="radio" name="temp0" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp0" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp-5')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp-5', -1) == $i)
              <input type="radio" name="temp-5" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp-5" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp-10')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp-10', -2) == $i)
              <input type="radio" name="temp-10" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp-10" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp-20')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp-20', -4) == $i)
              <input type="radio" name="temp-20" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp-20" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.temp-21')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('temp-21', -5) == $i)
              <input type="radio" name="temp-21" value="{{$i}}" checked> 
            @else
              <input type="radio" name="temp-21" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.wind8')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('wind8', -1) == $i)
              <input type="radio" name="wind8" value="{{$i}}" checked> 
            @else
              <input type="radio" name="wind8" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.wind17')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('wind17', -2) == $i)
              <input type="radio" name="wind17" value="{{$i}}" checked> 
            @else
              <input type="radio" name="wind17" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.clear')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('clear', 2) == $i)
              <input type="radio" name="clear" value="{{$i}}" checked> 
            @else
              <input type="radio" name="clear" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.clouds')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('clouds', 0) == $i)
              <input type="radio" name="clouds" value="{{$i}}" checked> 
            @else
              <input type="radio" name="clouds" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.light_rain')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('light_rain', -1) == $i)
              <input type="radio" name="light_rain" value="{{$i}}" checked> 
            @else
              <input type="radio" name="light_rain" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.rain')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('rain', -2) == $i)
              <input type="radio" name="rain" value="{{$i}}" checked> 
            @else
              <input type="radio" name="rain" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.heavy_rain')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('heavy_rain', -3) == $i)
              <input type="radio" name="heavy_rain" value="{{$i}}" checked> 
            @else
              <input type="radio" name="heavy_rain" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.drizzle')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('drizzle', -1) == $i)
              <input type="radio" name="drizzle" value="{{$i}}" checked> 
            @else
              <input type="radio" name="drizzle" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.light_snow')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('light_snow', 1) == $i)
              <input type="radio" name="light_snow" value="{{$i}}" checked> 
            @else
              <input type="radio" name="light_snow" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.snow')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('snow', -1) == $i)
              <input type="radio" name="snow" value="{{$i}}" checked> 
            @else
              <input type="radio" name="snow" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>

        <tr>
          <td>@lang('user.heavy_snow')</td>
          @for($i = -5; $i<=5; $i++)
            <td>
            @if(session('heavy_snow', -2) == $i)
              <input type="radio" name="heavy_snow" value="{{$i}}" checked> 
            @else
              <input type="radio" name="heavy_snow" value="{{$i}}">
            @endif
            </td>
          @endfor
        </tr>
      </tbody>
    </table>
  </div>
  <div class=form_button>
    <button type="submit" class="btn btn-primary">@lang('user.update')</button>
  </div>
</form>
@endsection
