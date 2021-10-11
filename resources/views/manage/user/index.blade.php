@extends('layouts.master')
@section('title') All Users @endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('pagetitle') Home @endslot
        @slot('title') All Users @endslot
    @endcomponent

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div>
                    <a href="{{route('all-users.create')}}" class="btn btn-primary waves-effect waves-light mb-3"><i
                            class="mdi mdi-plus mr-1"></i> Add user</a>
                </div>

                <div class="table-responsive custom-table mb-4">
                    <table class="table table-centered datatable dt-responsive nowrap table-check table-card-list"
                        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                        <thead>
                            <tr class="bg-transparent">
                                <th style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th style="width: 120px;">Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr id="row-{{$user->id}}">
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check-{{$user->id}}">
                                        <label class="custom-control-label" for="check-{{$user->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    @if($user->photo)
                                    <img src="{{ URL::asset('public/assets/profile/'.$user->photo) }}" alt="{{$user->name}}"
                                        class="avatar-xs rounded-circle mr-2">
                                    @else
                                    <div class="avatar-xs d-inline-block mr-2">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            {{strtoupper(substr($user->name, 0, 1))}}
                                        </span>
                                    </div>
                                    @endif
                                    <span>{{$user->name}}</span>
                                </td>
                                <td>
                                    <p class="mb-1">{{$user->username}}</p>
                                </td>

                                <td>{{$user->email}}</td>

                                <td>
                                    {{$user->role}}
                                </td>
                                <td>
                                    <a href="{{route('all-users.edit', $user->id)}}" class="px-3 text-primary" data-toggle="tooltip"
                                        data-placement="top" title="Edit"><i class="uil uil-pen font-size-18"></i></a>
                                    <a href="javascript:void(0);" class="px-3 text-primary delete-btn" data-toggle="tooltip" data-id="{{$user->id}}"
                                        data-placement="top" title="Delete"><i class="uil uil-trash font-size-18"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
@section('script')
    <!-- Ion Range Slider-->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>

    <script>
        $('.delete-btn').click(function () {
            id=$(this).data('id')
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#2a4fd7",
                cancelButtonColor: "#2a4fd7",
                confirmButtonText: "Yes, delete it!"
              }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url:"{{route('all-users.delete')}}",
                        type:'delete',
                        data:{
                            _token:"{{csrf_token()}}",
                            id:id
                        },
                        success:function(res){
                            console.log('data', res)
                            if(res){
                                $("#row-"+id).remove();
                                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                            }
                        },
                        error: function(e){
                            console.log('error')
                        }
                    })
                }
            });
        });
        </script>
@endsection
