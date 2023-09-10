@extends('layouts.layout')

@section('title')
AGF - Gestion des profils
@endsection

@section('links')
<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

@endsection

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h4>Gestion des profils</h4>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Profils</li>
      </ol>
    </div>
  </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title"><b> Liste des profils</b></h3>
    <div class="text-right">
      <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#createModal"><i class="fa-solid fa-circle-plus"></i> Ajouter un profil</a>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Code</th>
          <th>Nom</th>
          <th>Date de création</th>
          <th>Roles</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($profils as $profil)
        <tr>
          <td>
            {{ $profil->code }}
          </td>
          <td>
            {{ $profil->nom }}
          </td>
          <td>
            {{ $profil->created_at }}
          </td>
          <td>
            <ul>
              @foreach ($profil->roles as $role)
              <li>{{ $role->nom }} ({{ $role->description }}) </li>
              @endforeach
            </ul>
          </td>
          <td class="project-actions text-left">
            <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#viewModal{{ $profil->id }}"><i class="fas fa-folder"></i> Voir</a>
            <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#editModal{{ $profil->id }}"><i class="fas fa-pencil-alt"></i> Modifier</a>
            <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal{{ $profil->id }}"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

<!-- Create Modal -->
@include('profils.modals.create')

<!-- View Modal  -->
@include('profils.modals.show')

<!-- Edit Modal  -->
@include('profils.modals.edit')

<!-- Delete Modal  -->
@include('profils.modals.delete')

@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "pageLength": 5, // Limiter le nombre de lignes à 5 par page
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(document).ready(function() {
    // Reset form fields when the "Create" modal is hidden
    $('#createModal').on('hidden.bs.modal', function() {
      $('#createForm')[0].reset();
    });
    $('#createModal').on('hidden.bs.modal', function() {
      $('#createForm')[0].reset();
    });
  });
</script>

<!-- Les messages de succçès -->
@if ($message = Session::get('success'))
<script>
  Swal.fire('Action terminée !', '{{ $message }}', "success");
</script>
@endif

<!-- Les messages d'erreurs -->
@if ($message = Session::get('error'))
<script>
  toastr.options = {
    "closeButton": true
  }
  toastr.error("{{ $message }}");
</script>
@endif

<!-- Les erreurs de validation -->
@if ($errors->any())
<script>
    // Ouvrir le modal s'il y a des erreurs de validation
    $(document).ready(function() {
        $('#createModal').modal('show');
    });
</script>
@foreach ($errors->all() as $error)
<script>
  toastr.options = {
    "closeButton": true
  }
  toastr.error("{{ $error }}");
</script>
@endforeach
@endif

@endsection