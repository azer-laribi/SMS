@extends('layouts.admin')

@section('title')
    <title>Employees</title>
@endsection
@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{ __('ClassRooms') }}
                        </div>

                    <div class="card-body">
                        <table class="table" id="myTable" action="/classroom" method="POST">
                            <div class="float-sm-right " style="margin-bottom: 10px; ">
                                <a href="/classroom-create" class="btn btn-success btn-icon-split ">
                                <span class="icon text-white-50 ">
                                <i class="fas fa-plus"></i>
                                 </span>
                                    <span class="text">new classroom</span>
                                </a>
                            </div>
                            <thead>
                            <tr>
                                <th scope="col">class name </th>
                                <th scope="col">number of student</th>
                                <th scope="col"> year </th>
                                <th scope="col" style="text-align: center">action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classrooms as $classroom)

                                <tr>
                                    <td>{{$classroom->name}}</td>
                                    <td>{{$classroom->number}}</td>
                                    <td>{{$classroom->year}}</td>

                                    <td>
                                        <div class="row" style="display: flex; justify-content: center;">

                                            <a  href="{{route('classroom.studentList',$classroom->id)}}"
                                                class="btn btn-warning btn-circle mr-1">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>


                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection



