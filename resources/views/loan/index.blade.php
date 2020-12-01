<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Prestamos') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
           @if (Auth::user()->hasPermissionTo('delete loans')) 
                   <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addLoanModal" type="submit">
                     Añadir Prestamo
                  </button>       


           @endif

          
        </div>
      </div>     
    </x-slot>
 

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">book_id</th>
              <th scope="col">user_id</th>
              <th scope="col">Fecha prestamo</th>
              <th scope="col">Fecha devolucion</th>
              <th scope="col">Estado</th>
              

            </tr>
          </thead>
          <tbody>


            @if (isset($loans) && count($loans)>0)
            @foreach($loans as $loan)
            <tr>
              <th scope="row">
                {{ $loan->id }}
              </th>
              <td>
                {{ $loan->book_id }}
              </td>
              <td>
                {{ $loan->user_id }}
              </td>
              <td>
                {{ $loan->Fecha_prestamo }}
              </td>
              <td>
                 {{ $loan->Fecha_devolucion }}
              </td>
              <td>
                 {{ $loan->Estatus }}
              </td>
               @if (Auth::user()->hasPermissionTo('delete loans')) 
                    <td>
                       <button onclick="editLoan(  {{ $loan->id }},'{{  $loan->book_id }}','{{  $loan->user_id }}','{{  $loan->Fecha_prestamo }}','{{  $loan->Fecha_devolucion }}','{{  $loan->Estatus }}' )"    class="btn btn-primary float-center" data-toggle="modal" data-target="#editLoanModal">
                        Edit
                       </button> 

                      <button onclick="removeLoan({{ $loan->id }})" class=" btn-danger">
                           Remove
                      </button>
                    </td>
                     
                  
             @endif
          
            </tr>
            
              @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>

 {{--  find del modal para agregar usuario ROTO --}}


      <div class="modal fade" id="editLoanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new Loan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ url('Loan')}}" >
                @csrf
                @method('PUT')
                <div class="modal-body">
                     
                  {{-- parte del modal para agregar libro  --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Libro</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="libro" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="libro">
                          </div>      

                       
                      </div>


                  {{-- parte del modal para agregar usuario  --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre usuario</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="usuario" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="usuario">
                          </div>                          
                       
                      </div>

                         {{-- parte del modal para agregar fecha de prestamo  --}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">fecha de prestamo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="date" name="prestamo" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="prestamo">
                          </div>                          
                       
                      </div>

                   <div class="form-group">
                        <label for="exampleInputEmail1">fecha de regreso</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="date" name="regreso" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="regreso">
                          </div>                          
                       
                      </div>
                 
                             <div class="form-group">
                        <label for="exampleInputEmail1">Estado</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" name="estado" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="estado">
                          </div>                          
                       
                      </div>

                </div>

                  <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <input type="hidden" name="id" id="id">
                  </div>

              </form>               
      </div>
    </div>
  </div>

       <x-slot name="scripts">
         <script type="text/javascript">

            function editLoan(id,book_id,user_id,Fecha_prestamo,Fecha_devolucion,Estatus) {
              
             $("#libro").val(book_id)
             $("#usuario").val(user_id)
             $("#prestamo").val(Fecha_prestamo)
             $("#regreso").val(Fecha_devolucion)
             $("#estado").val(Estatus)

            }

             function removeLoan(id){
            swal({
           title :" are you sure ",
          text :" are you sure ",
           icon :"warning",
            buttons : true,
            dangerMode: true,
            })
            .then((willDelete) =>{

              if(willDelete){
                axios.delete('{{  url('Loan') }}',{

                  id: id,
                  _token: '{{  csrf_token()  }}'
                })
                .then(function(response){
                  
                  if(response.data.code==200){
                    swal(response.data.message ,{
                       icon: "sucess"
                    });
                    $(target).parent().parent().remove();
                  }
                })
                .catch(function (error){
                   
                   swal('Error ocurred');

                });
              }

            });
        }

        </script>   
      

      </x-slot>









</x-app-layout>
