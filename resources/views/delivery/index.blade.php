@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Delivery Zone</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Delivery</a></p>
@stop

@section('content')
    <div class="row">
        <div class=" col-md-12 col-12 col-sm-12 col-lg-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <p><span class="h3"> {{ $count }} </span> Delivery Zones</p>
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
                      <th scope="col">Delivery Zone</th>
                      <th scope="col">Delivery Cost</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($delivery as $data)
                    <tr>
                      <th scope="row">{{$data->id}}</th>
                      <td>{{$data->area_name}}</td>
                      <td> {{ $data->delivery_cost }} </td>
                      <td>
                       
                        <a href="{{route('delivery.edit',$data->id)}}" class="btn btn-solid btn-warning text-info"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                        <a class="btn btn-solid btn-light text-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                      </td>
                    </tr>

                    @empty
                     <tr>
                      <td colspan="100%" class="text-center">No Delivery Data Found <a href="delivery/create" class="btn btn-solid btn-primary ">Add Delivery Zone</a></td>
                    </tr>

                   @endforelse
                  </tbody>
            </table>
               </div>
           </div>
            
        </div>       
    </div>

  
@if(count($delivery) > 0)

<!-- Modal -->
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
        <form method="POST" action="{{route('delivery.destroy',$data->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" name="delete" class="btn btn-danger" value="YES" >
        </form>
      </div>
    </div>
  </div>
</div>
@endif

@stop

@section('js')
    <script>
         $('#category_table').DataTable();
     </script>
@stop