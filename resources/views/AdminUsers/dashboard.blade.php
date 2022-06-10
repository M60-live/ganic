@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      <div class="spacer"></div>
      <div class="row">
        <div class="col col-md-12">
          @include('layouts.admin_nav')
        </div>
      </div>
      <div class="spacer"></div>
      <div class="row">
        <div class="col col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/users/dashboard">Main Menu</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12">
          <table class="table table-bordered">
            <thead><th></th><th>Name</th><th>Email</th><th>Reg Date</th><th>Action</th></thead>
            <tbody>
              <?php $cnt=$Users->total(); ?>
              @foreach($Users as $user)
                <tr>
                  <td>{{ $cnt  - ($Users->perPage() * ($Users->currentPage()-1)) }}</td>
                  <td><a href="/admin/users/view_user/{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</a></td>
                  <td>{{ $user->email }}</td>
                  <td>{{ date('d F Y',strtotime($user->created_at)) }}</td>
                  <td><a href="/admin/users/view_user/{{ $user->id }}" class="btn btn-primary">View</a></td>
                </tr>
                <?php $cnt--; ?>
              @endforeach
            </tbody>
          </table>
          <div style="margin: auto; display: flex; justify-content: center;">
            {{ $paginate }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection