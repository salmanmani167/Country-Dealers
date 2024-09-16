<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ucwords($title)}}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">{{ucwords($title)}}</li>
            </ul>
        </div>
        {{$slot}}
        
    </div>
</div>
