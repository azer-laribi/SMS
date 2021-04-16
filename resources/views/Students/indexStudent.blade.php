@extends('layouts.indexStudent')

@section('title')
  Students
@endsection



@section('content')
@foreach($exercices as $exercice)
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exercice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form accept-charset="UTF-8" action="{{route('RemisExercice',$exercice->id )}}" method="POST" enctype="multipart/form-data">
              <div class="modal-body">
              @csrf
              <div class="form-group mt-3">
                <label class="mr-2">Choisie un Fichier:</label>
                <input id="file" type="file" name="file">
              </div>
              <hr>
            </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
          <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
  </form>
  </div>
</div>
</div>
</div>
@endforeach

@if (session('status'))
  <div class="alert alert-success">
      {{ session('status') }}
  </div>
@endif
<div class="row">

  <div class="card card col-md-6 col-lg-6">
    <div class="card-body">
        <h3 class="card-title" style="text-align:center; color : Red"> <b>Exercice</b></h3><hr>
        @foreach ($exercices as $exercice)
        @foreach($matieres as $matiere)
        @if(\Carbon\Carbon::parse (\Carbon\Carbon::now()) <= (\Carbon\Carbon::parse ($exercice->deadline))&& $exercice->Matiere_id == $matiere->id)
        <div class=" alert alert-danger alert-icon" role="alert">
           <i class="fas fa-calendar-alt"> </i><b> {{\Carbon\Carbon::now()->toFormattedDateString()}}</b>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="alert-icon-content">
                <h4 class="alert-heading"><b><i class="fas fa-file-pdf"></i>  {{$exercice->name}}  |  {{$matiere->name}}  |  {{$exercice->deadline}}</b></h4>
                il vous reste {{ \Carbon\Carbon::parse (\Carbon\Carbon::now())->diffInDays(\Carbon\Carbon::parse ($exercice->deadline))}} jours pour remettre cette exercice
            </div>
            <hr>
            <div class="">
              <a href="{{route('DownloadExercices',$exercice->id )}}"
               class="btn btn-danger btn-circle mr-1" >
                <i class="fas fa-download"></i>
              </a>
              <a data-toggle="modal" data-target="#exampleModal"
               class="btn btn-danger btn-circle mr-1 float-right" >
                <i class="fas fa-plus"></i>
              </a>
            </div>
        </div>
        @endif
        @endforeach
        @endforeach
    </div>
  </div>
    <div class="card card col-md-6 col-lg-6">
      <div class="card-body">
          <h3 class="card-title" style="text-align:center; color : Green"> <b>Exercice Remis</b></h3><hr>
          @foreach ($exerciceRemis as $exerciceRemi)
          @foreach($matieres as $matiere)
          <div class=" alert alert-success alert-icon" role="alert">
             <i class="fas fa-calendar-alt"> </i><b> {{\Carbon\Carbon::now()->toFormattedDateString()}}</b>
              <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
              <div class="alert-icon-content">
                  <h6 class="alert-heading"><b><i class="fas fa-file-pdf"></i> {{$exerciceRemi->file_name}}  |  {{$matiere->name}}  |  {{$exerciceRemi->created_at->toFormattedDateString()}}</b></h6>  </div>
          </div>
          @endforeach
          @endforeach
      </div>
    </div>


</div>
<hr>
<div class="card col-md-12 col-lg-12">
  <div class="card-body">
    <h3 class="card-title" style="text-align:center; color : Skyblue"> <b>Student</b><a class="btn btn-outline-info float-right" href="/fullcalendareventmaster" role="button" target="_blank"><i class="fas fa-calendar-alt"></i> Evenement</a></h3><hr>
    <div class="row">
      <div class="card col-md-4 col-lg-4 bg-info" >
        <div class="card-body">
          <h5 class="card-title" style="text-align:center; color : white"> <b>Cours</b> </h5> <hr>
          <a  class="nav-link collapsed" href="./CourStudents" style="display : flex; color : white"  aria-expanded="true" aria-controls="collapseUtilities" target="_blank">
            <i class='fas fa-chalkboard-teacher' style='font-size:50px'></i><h4> <p style="text-align:right; margin-left:100px;"><b>{{$cours->count()}}<br>Cours</b></p><br> </h4>
          </a>
        </div>
      </div>
        <div class="card col-md-4 col-lg-4 text-white bg-danger" >
          <div class="card-body">
            <h5 class="card-title" style="text-align:center;"> <b>Exercice</b> </h5> <hr>
            <a  class="nav-link collapsed" href="./ExerciceStudents" style="display : flex; color : white"  aria-expanded="true" aria-controls="collapseUtilities" target="_blank">
              <i class='fas fa-book-medical' style='font-size:50px'></i><h4> <p style="text-align:right; margin-left:100px;"><b>{{$exercices->count()}}<br>Exercices</b></p><br> </h4>

            </a>
          </div>
        </div>
      <div class="card col-md-4 col-lg-4 bg-success text-white">
        <div class="card-body">
          <h5 class="card-title" style="text-align:center;"> <b>Note</b> </h5> <hr>
          <a  class="nav-link collapsed" href="./NoteStudent" style="display : flex;  color : white"  aria-expanded="true" aria-controls="collapseUtilities" target="_blank">
            <i class="fas fa-clipboard-check float-left" style='font-size:50px'> </i><h4> <p style="text-align:right; margin-left:150px;"><b>
            <?php
              $id = Auth::guard('student')->user()->id;
              $connection = mysqli_connect("localhost","root","","project1");
              $query = "SELECT id FROM notes WHERE Student_id = $id";
              $query_run = mysqli_query($connection,$query);
              $row = mysqli_num_rows($query_run);
              echo ''.$row.'';
            ?>
            <br>Notes</b></p></h4>
          </a>
        </div>
      </div>
    </div>
  </div>

</div>
<iframe width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=e49b0546-37eb-4812-a037-48c70b1ce5a0&autoAuth=true&ctid=dbd6664d-4eb9-46eb-99d8-5c43ba153c61&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXdlc3QtZXVyb3BlLXJlZGlyZWN0LmFuYWx5c2lzLndpbmRvd3MubmV0LyJ9" frameborder="0" allowFullScreen="true"></iframe>
@endsection
