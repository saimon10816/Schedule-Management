@extends('layout.adminLayout')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-12">
            <h2 class="heading-section">___________</h2>
        </div>
    </div>
    <div class="contents">

        <div class="container-fluid">
            <div class="social-dash-wrap">
                <div class="col-lg-12">

                    <div class="breadcrumb-main">
                        <h4 class="text-capitalize breadcrumb-title">Attendance Management</h4>
                        <div class="breadcrumb-action justify-content-center flex-wrap">

                        </div>
                    </div>

                </div>
                <div class="wrapper wrapper--w1070">
                    <div class="card card-7">
                        <div class="card-body">
                            <form class="form" method="GET" action="{{route('admin.companyB.search')}}">
                                <div class="input-group input--large">
                                    <label class="label">Post Site</label>
                                    <input class="input--style-1" type="text" placeholder=""
                                           name="postSite">
                                </div>
                                <div class="input-group input--medium">
                                    <label class="label">Guard Name</label>
                                    <input class="input--style-1" type="text" placeholder=""
                                           name="guardName">
                                </div>
                                <div class="input-group input--medium">
                                    <label class="label">Date From</label>
                                    <input class="input--style-1" type="date" name="date_from"
                                           placeholder="mm/dd/yyyy" id="date_from">
                                </div>
                                <div class="input-group input--medium">
                                    <label class="label">Date To</label>
                                    <input class="input--style-1" type="date" name="date_to"
                                           placeholder="mm/dd/yyyy" id="date_to">
                                </div>

                                <button class="btn-submit-s" type="submit">search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="wrapper wrapper--w1070">
                    <div class="card card-7">
                        <div class="card-body">
                            <div class="card-header">
                                <h6>Data Table</h6>
                            </div>
                            {{--                                @if (auth()->check())--}}
                            {{--                                    @if (auth()->user()->isAdmin())--}}
                            {{--                                        <a href="{{route('admin.companyA.create')}}"--}}
                            {{--                                           class="btn btn-primary">{{'Add'}}</a>--}}
                            {{--                                    @endif--}}
                            {{--                                @endif--}}
                        </div>

                        <div class="card-body p-0">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="st_matrics-today" role=""
                                     aria-labelledby="st_matrics-tab">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-social">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col" colspan="2">Information</th>
                                                <th scope="col" colspan="4">Behavior</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Id</td>
                                                <td>Date</td>
                                                <td>Post Site</td>
                                                <td>Guard Name</td>
                                                <td>Shift Start</td>
                                                <td>Shift End</td>
                                                <td>Total Hour</td>
                                                <td>Remarks</td>
                                                @if (auth()->check())
                                                    @if (auth()->user()->isAdmin())
                                                        <td>Edit</td>
                                                        <td>Delete</td>
                                                    @endif
                                                @endif
                                            </tr>
                                            @if(count($companyBsearches) > 0)
                                                @foreach($companyBsearches as $companyBsearch)
                                                    <tr>
                                                        <td>
                                                            {{$companyBsearch->id}}
                                                        </td>
                                                        <td>
                                                            <a href="">{{$companyBsearch->date}}</a>
                                                        </td>
                                                        <td>{{$companyBsearch->postSite}}</td>
                                                        <td>{{$companyBsearch->guardName}}</td>
                                                        <td>{{$companyBsearch->shiftStart}}</td>
                                                        <td>{{$companyBsearch->shiftEnd}}</td>
                                                        <td>{{$companyBsearch->totalHour}}</td>
                                                        <td>{{$companyBsearch->remarks}}</td>
                                                        @if (auth()->check())
                                                            @if (auth()->user()->isAdmin())
                                                                <td>
                                                                    <a href="{{route('admin.companyA.edit', $companyBsearch->id)}}"
                                                                       class="btn btn-primary">{{'Edit'}}</a>
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{route('admin.companyA.delete', $companyBsearch->id)}}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <input type="submit" name="submit"
                                                                               value="Delete"
                                                                               class="btn btn-danger">
                                                                    </form>
                                                                </td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Sum of Total Hour = {{$companyBsearches->sumOfTotalHour}}</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
