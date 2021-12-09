@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Discount</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Discount</a></p>
@stop

@section('content')
    <div class="row">
        <div class=" col-md-6 col-6 col-sm-12 col-lg-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <p><span>1</span> All Discounts</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-6 col-6 col-sm-12 col-lg-6 col-xs-6">
            <div class="card">
                <div class="card-body">
                    <p><span>2</span> Active Discounts</p>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
           <div class="card">
               <div class="card-body">
                   <table id="discount_table" class="table table-hover table-responsive-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Discount Code</th>
                      <th scope="col">Discounted Product</th>
                      <th scope="col">Discount Percentage</th>
                      <th scope="col">Discount Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($discount as $data)
                    <tr>
                      <th scope="row">{{$data->id}}</th>
                      <td>{{$data->code}}</td>
                      <td>
                       <img src=" {{asset('storage/images/'.$data->product->product_image)}} " height="50px" width="50px">
                       {{ $data->product->product_name }} 
                      </td>
                      <td> {{ $data->percentage }}% </td>
                      <td> 
                            @if($data->active == 0)
                             <p class="btn btn-solid btn-secondary" >Not Active</p>
                            @else
                             <p class="btn btn-solid btn-success" >Active</p>
                            @endif
                      </td>
                      <td>
                       
                        <a href="{{route('discount.edit',$data->id)}}" class="btn btn-solid text-info"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                        <a class="btn btn-solid btn-light text-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                      </td>
                    </tr>

                    @empty
                     <tr>
                      <td colspan="100%" class="text-center">No Discount Found <a href="discount/create" class="btn btn-solid btn-success">Generate Discount Code</a></td>
                    </tr>

                   @endforelse
                  </tbody>
            </table>
               </div>
           </div>
            
        </div>       
    </div>

  
@if(count($discount) > 0)

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
        <form method="POST" action="{{route('discount.destroy',$data->id)}}">
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
         $('#discount_table').DataTable();
     </script>
@stop