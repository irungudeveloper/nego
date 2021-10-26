@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Category</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Category</a></p>
@stop

@section('content')
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="card">
              <div class="card-body">
                  <form method="POST" action="{{route('category.update',$category->id)}}">
                      @csrf
                      @method('PUT')
                    <label for="category_name">Category Name</label>
                    <input id="category_name" type="text" name="category_name" value="{{$category->category_name}} " class="form-control">
                    <div class="col-12 text-center p-3">
                        <input type="submit" name="submit" class=" btn btn-solid btn-primary" value="Update Category">
                    </div>
                  </form>
              </div>
          </div>
        </div>       
    </div>
@stop
