@extends('layouts.app')

@section('content')
<div class="container">  
  <div class="row">
      <div class="col-md-12">

        @if (session('message'))
        <div class="alert alert-sucess">{{ session('message')}}</div>
        @endif
          <div class="card">
              <div class="card-header">
                  <h4>Cartegory Details
                      <a href="{{url('admin/cartegory/create')}}" class="btn btn-primary float-end">Add Cartegory</a>
                  </h4>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($cartegories as $item)
                          <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                Action
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