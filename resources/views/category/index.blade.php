@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Category</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Category</a></p>
@stop

@section('content')
    <div class="row">
        <div class=" col-md-6 col-6 col-sm-12 col-lg-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <p><span>12</span> Existing Categories</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-6 col-6 col-sm-12 col-lg-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <p><span>111</span> Products</p>
                </div>
            </div>
            
        </div>
    </div>
    


    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
           <div class="card">
               <div class="card-body">
                   <table id="category_table" class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Category Name</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>



                    @forelse($category as $data)
                    <tr>
                      <th scope="row">{{$data->id}}</th>
                      <td>{{$data->category_name}}</td>
                      <td>
                       
                        <a href="{{route('category.edit',$data->id)}}" class="btn btn-solid btn-warning text-info"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                        <a class="btn btn-solid btn-light text-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="100%" class="text-center">No Category Data Found <a href="category/create" class="btn btn-solid btn-primary ">Add Category</a></td>
                    </tr>
                   @endforelse

                    @if(count($category) > 0)
                   
                   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are You Sure
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <form method="POST" action="{{route('category.destroy',$data->id)}}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="delete" class="btn btn-danger" value="YES" >
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                   
                  </tbody>
            </table>
               </div>
           </div>
            
        </div>       
    </div>

  

<!-- Modal -->
@stop

@section('js')
    <script>
         $('#category_table').DataTable();
     </script>
@stop