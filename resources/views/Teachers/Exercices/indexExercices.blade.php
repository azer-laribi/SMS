@extends('layouts.indexTeacher')

@section('title')
  Cours
@endsection
@section('style')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Exercices</h6><a class="btn btn-primary float-right" href="/AjouterExercices" role="button" >Ajouter Exercice</a>
                        </div>
                        <div class="card-body">
                          @if (session('status'))
                              <div class="alert alert-success">
                                  {{ session('status') }}
                              </div>
                          @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align : center">
                                            <th>Titre </th>
                                            <th>Maiter</th>
                                            <th>Classe</th>
                                            <th>Date Limite</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($exercices as $exercice)
                                      @foreach($matieres as $matiere)
                                      @foreach($classes as $classe)
                                      @if($exercice->Matiere_id == $matiere->id && $exercice->Classe_id == $classe->id )
                                        <tr style="text-align : center">
                                          <td>{{$exercice->name}}</td>
                                          <td>{{$matiere->name}}</td>
                                          <td>{{$classe->name}}</td>
                                          <td>{{$exercice->deadline}}</td>
                                          <td>
                                            <div class="row" style="display : flex; justify-content:center;">
                                              <a href="{{route('DownloadExercices',$exercice->id )}}"
                                               class="btn btn-primary btn-circle mr-1" >
                                                <i class="fas fa-download"></i>
                                              </a>
                                                <a  href="{{route('exercice.view',$exercice->id )}}"
                                                   class="btn btn-warning btn-circle mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                              <form action="{{route('DeleteExercices',$exercice->id)}}"
                                                      method="POST"
                                                      class="float-left">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button  type="submit" class="btn btn-danger btn-circle mr-1"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                              </div>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection

@section('javascript')
  <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
  } );
  </script>
@endsection
