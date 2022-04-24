@extends('layouts.app')
@section('content')
@if (auth()->user() != null)
<div class="container">
    @if(\Session::has('message'))

      <p class="alert
      {{ Session::get('alert-class', 'alert-success') }}">{{Session::get('message') }}</p>
      
      @endif
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                          <p class="text-center mb-0">Latest Rates</p>
                        </div>
                        <form class="form-inline" action="{{ route('api.filter') }}" method="get">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="main_rate" class="col-sm-4 col-form-label">Main rate: <strong class="text-decoration-underline">{{$newData->base_code}}</strong></label>
                                <select name="main_rate" class="form-select" id="" onchange="this.form.submit()">
                                    <option value="pick" selected>Pick a default rate</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="BGN">BGN</option>
                                </select>
                            </div>
                        </form>
                        {{-- Filter Rates --}}
                        <form class="form-inline" action="{{ route('api.filter') }}" method="get">
                            @csrf
                            <div class="form-group mb-2">
                              <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                              <input type="text" class="form-control" id="filter" name="filter" placeholder="Rate name...">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                          </form>
                          
                        
                        {{-- Sort Rates --}}
                        <h6 class="mt-3 mb-2">Sort by</h6>
                        <div class="">
                            @sortablelink('rate', 'Rate')
                            @sortablelink('value', 'Value')
                        </div>
                       
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    {{-- {{dd($newData)}} --}}
                    @foreach ($filterData as $dt)
                    <div class="row">
                        <p>
                            {{$dt->rate}}: {{$dt->value}}
                        </p>
                    </div>
                    @endforeach
                </div>
                <div class="card-body">
                    {{-- {{ $filterData->links('pagination::bootstrap-4') }} --}}
                    {!! $filterData->appends(Request::except('page'))->render() !!}

                    <p>
                        Displaying {{$filterData->count()}} of {{ $filterData->total() }} rate(s).
                    </p>
                </div>
            </div>


        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Chart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <canvas id="myChart" width="400" height="200"></canvas>
                    <script>
                       
                        var app = @json($filterJson);
                        
                        const ctx = document.getElementById('myChart').getContext('2d');
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {

                                datasets: [{
                                    label: '{{$newData->base_code}}' ,
                                    data: app,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                    </script>

                </div>
            </div>
           <div class="col-lg-4 col-md-12">
            <div class="card mt-4">
                <div class="card-header align-center">
                    Export the latest exchange data as a .csv file
                </div>
                <div class="card-body text-center">
                    
                    @if ($filters == null)
                        <a href="{{route('export')}}" id="export" class="btn btn-success m-1" onclick="exportTasks(event.target);">Export</a>
                    @else
                        <a href="{{route('export')}}" id="export" class="btn btn-success m-1" onclick="exportTasks(event.target);">Export</a>
                        <a href="{{route('export.filter', $filters)}}" id="export_filter" class="btn btn-danger m-1" onclick="exportTasks(event.target);">Export Filter</a>
                    @endif
                </div>
            </div>
           </div>
        </div>
    </div>
</div>
<script>
    function exportTasks(_this) {
       let _url = $(_this).data('href');
       window.location.href = _url;
    }
 </script>

@else
<script>window.location = "{{ route('login') }}";</script>
@endif
@endsection
