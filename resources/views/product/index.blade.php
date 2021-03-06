@extends('adminlte::page')

@section('title', 'NEGO | E-com')

@section('content_header')
    <h1 class="m-0 text-dark">Brand</h1>
    <p><a href="#">Dashboard</a>/<a href="#">Brand</a></p>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
            <div class="card">
                <div class="card-body bg-info">
                    <p><span class="h3"> {{ $total_products }} </span> Total Products</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
            <div class="card">
                <div class="card-body bg-success">
                    <p><span class="h3"> {{ $available_products }} </span> Available Products</p>
                </div>
            </div>
            
        </div>
        <div class="col-md-4 col-12 col-sm-12 col-lg-4 col-xs-4">
            <div class="card">
                <div class="card-body bg-primary">
                    <p><span class="h3" > {{ $negotiable_products }} </span> Negotiable Products</p>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xs-12">
           <div class="card">
               <div class="card-body">
                <table id="category_table" class="table table-hover table-responsive">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Product Image</th>
                      <th scope="col">Product Quantity</th>
                      <th scope="col">Product Price</th>
                      <th scope="col">Retail Price</th>
                      <th scope="col">Final Price</th>
                      <th scope="col">Negotiable</th>
                      <th scope="col">Availability Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($product as $data)
                    <tr>
                      <th scope="row">{{$data->id}}</th>
                      <td>{{$data->product_name}}</td>
                      <td><img src="{{asset('storage/images/'.$data->product_image)}}" height="50px" width="50px"></td>
                      <td> {{$data->product_quantity}} </td>
                      <td> {{ $data->product_price }} </td>
                      <td> {{ $data->product_retail_price }} </td>
                      <td> {{ $data->product_final_price }} </td>
                      <td> 
                            @if($data->negotiable == 1) 
                                <button class="btn btn-solid btn-success">Negotiable</button>
                            @else
                                <button class="btn btn-solid btn-secondary">Not Negotiable</button>
                            @endif
                        </td>
                         <td> 
                            @if($data->availability_status == 1) 
                                <button class="btn btn-solid btn-success">Available</button>
                            @else
                                <button class="btn btn-solid btn-secondary">Not Available</button>
                            @endif
                        </td>
                      <td>
                       
                        <a href="{{route('product.edit',$data->id)}}" class="btn btn-solid btn-warning text-info"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                        <a class="btn btn-solid btn-light text-danger" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-lg fa-fw fa-trash"></i></a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="100%" class="text-center">No Product Data Found <a href="product/create" class="btn btn-solid btn-primary ">Add Product</a></td>
                    </tr>
                   @endforelse
                  </tbody>
            </table>
               </div>
           </div>
            
        </div>       
    </div>

  
@if(count($product) > 0)
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
        <form method="POST" action="{{route('product.destroy',$data->id)}}">
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