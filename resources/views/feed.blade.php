@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 container-profile100">
    @sharedAlerts
    @foreach ($stories as $story)

    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6 py-2 col-sm-12">
            <a href="{{ route('stories.show', ['story' => $story->id]) }}" class="custom-card">
                <div class="card h-100 shadow">

                                        <!--
                    
                    1. Images can be more then 3
                    2. Images can be 2
                    3. Image can 1
                    
                    -->
                    <?php $len = !is_null($story->TheOtherImage) ? count($story->TheOtherImage) : 0; ?>
                    @switch($len)
                     
                        @case(1)
                            
                            <div class="card-img-2-by-2" style="background: url('{{ $story->TheImage }}')"></div>
                            <div class="card-img-2-by-2" style="background: url('{{ $story->TheOtherImage[0] }}')"></div>

                            @break

                        @case(2)
                        
                            @foreach($story->TheOtherImage as $image)
                                <div style="height: 220px; overflow: hidden;margin-bottom: 2px;">
                                <img src="{{ $image }}" class="card-img-top" alt="{{ $story->title }}">                
                                </div>
                            @endforeach  
                        
                        @break
                        
                        @case(0)
                        
                        <img src="{{ $story->theImage }}" class="card-img-top" alt="{{ $story->title }}">

                        @break

                    @default
                    
                        <div class="container">
                          <div class="row">
                            <div class="col-md-6 card-mult-img-height card-bg-mult-img" style="background: url('{{ $story->TheImage }}')"></div>
                            <div id="sideImages" class="col-md-6" style="padding: 0;">
                              <div style="background-image: url({{$story->TheOtherImage[0]}});height: 50%; background-position: center; background-size: cover;"  style="padding: 0;"></div>
                              <div style="background-image: url({{$story->TheOtherImage[1]}}); height: 50%; background-position: center; background-size: cover;"  style="padding: 0;">
                                 {{-- @if( ( count($story->theImage) - 3 ) != 0  )
                                    <span>{{count($story->theImage) - 3}}</span> 
                                  @endif --}}
                                  <span style="width: 100%; height: 100%;    background: black;    display: block;     color: white;    opacity: 0.4;    font-size: 11.2rem;    text-align: center;">{{count($story->TheOtherImage)}}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                    
                    @break
                    
                    @endswitch

                    {{-- //commented ameer.. --}}
                   {{--  <img src="{{ $story->theImage }}" class="card-img-top" alt="{{ $story->title }}"> --}}
                    <div class="card-body">
                        @include('shared.user-connection-lists')
                        <h5 class="card-title">{{ $story->title }}</h5>
                        <p class="card-text">{!! $story->theDescription !!}</p>
                        {{-- <input type="hidden" value="amo" class="facemocion"/> --}}
                        @include('layouts._emotions', ['story' => $story])
                        <div>
                            @can('update', $story)
                                <a href="{{ route('stories.edit', ['story' => $story]) }}" class="btn btn-secondary">Edit</a>
                            @endcan
                            @can('delete', $story)
                                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); var r = confirm('Are you sure?');  if (r) { document.getElementById('delete-story-form-{{ $story->id }}').submit(); }">Delete</a>
                                <form id="delete-story-form-{{ $story->id }}" action="{{ route('stories.destroy', ['story' => $story]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan
                        </div>
                    </div>
                    <!-- div class="card-footer">
                        <small class="text-muted">{{ $story->theFormattedTimeAgo }}</small>
                        <small class="text-muted float-right">Posted by:
                            <a href="{{ route('users.show', ['user' => $story->user]) }}">
                                <img src="{{ $story->user->thePhoto }}" title="{{ $story->user->getFullName() }}" alt="{{ $story->user->getFullName() }}" class="img-thumbnail rounded-circle" style="width: 30px; height: 30px;">
                            </a>
                        </small>
                    </div -->
                </div>
            </a>
        </div>
    </div>
    @endforeach
    <div class="row justify-content-center">
        {{ $stories->links() }}
    </div>
</div>
@endsection
