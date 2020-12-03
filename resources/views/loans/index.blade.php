  @php
      use Carbon\Carbon;
  @endphp
<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Préstamos') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          
          

           @if (Auth::user()->hasPermissionTo('delete loans')) 
                   <button class="btn btn-warning float-right" data-toggle="modal" data-target="#showAllModal">
                    Ver todos los préstamos
                  </button>     
           @endif
                  <button style="margin-left: 5px; margin-right: 5px;" class="btn btn-primary float-right"  data-toggle="modal" data-target="#showHistoryModal">
                    Ver historial
                  </button> 
          
        </div>
      </div>     
    </x-slot>   

    <div class="py-12">
      
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
              <table class="table table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Libro</th>
              <th scope="col">Usuario</th>
              <th scope="col">Fecha prestamo</th>
              <th scope="col">Fecha devolucion</th>
              <th scope="col">Estado</th>
              <th scope="col"></th>

            </tr>
          </thead>
          <tbody>

            @if (isset($loans) && count($loans)>0)
            @foreach($loans as $loan)
              @php
                $user = auth()->user();
              @endphp
                @if($loan->user_id==$user->id)
                  <tr class="loan_Table" @if($loan->status==0) style="display: none;" @endif>
                    <td>
                      @foreach($books as $book)
                        @if($book->id==$loan->book_id)
                         {{ $book->title }}
                        @endif
                      @endforeach
                    </td>
                    <td>
                      @if($user->id==$loan->user_id)
                      {{ $user->name }}
                      @endif
                    </td>
                    <td>
                      {{ $loan->loan_date }}
                    </td>
                    <td>
                       {{ $loan->return_date }}
                    </td>
                    <td>
                      <span>En posesión</span>
                    </td>
                          <td>
                            <button onclick="returnBook({{ $loan->id }},{{ $loan->book_id }}, '{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success" @if($loan->status==0) disabled @endif>
                                 Devolver
                            </button>
                          </td>
                  </tr>
                @endif
              @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>


        

        <div class="modal fade" id="showHistoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Historial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="modal-body">
                  
                  <div class="py-12">
          
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                  <table class="table table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Libro</th>
                  <th scope="col">Fecha prestamo</th>
                  <th scope="col">Fecha devolucion</th>
                  <th scope="col">Estado</th>


                </tr>
              </thead>
              <tbody>

                      @if (isset($loans) && count($loans)>0)
                        @foreach($loans as $loan)
                          @if($loan->user_id==$user->id)
                                 <tr >
                                  <td>
                                    @foreach($books as $book)
                                      @if($book->id==$loan->book_id)
                                       {{ $book->title }}
                                      @endif
                                    @endforeach
                                  </td>
                                  <td>
                                    {{ $loan->loan_date }}
                                  </td>
                                  <td>
                                     {{ $loan->return_date }}
                                  </td>
                                  <td>
                                    @if($loan->status==0)
                                      <span>Devuelto</span>
                                    @else
                                      <span>En posesión</span>
                                    @endif  
                                  </td>
                                 </tr>
                          @endif
                        @endforeach
                      @endif
              </tbody>
            </table>

                </div>
            </div>
          </div>
                    



                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    <input type="hidden" id="id" name="id">
                  </div>
                
                
              </div>
            </div>
        </div>

    <div class="modal fade" id="showAllModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lista de usuarios</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
              
              <div class="py-12">
          
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                          <table class="table table-striped table-bordered">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Usuario</th>
                          <th scope="col"></th>

                        </tr>
                      </thead>
                      <tbody>

                        
                         @foreach($users as $user)
                              <tr class="loan_Table" >
                                <td>
                                  {{ $user->name }}
                                </td>
                                      <td>
                                          <a href="{{url('/loans/'.$user->id)}}" >
                                              <button class="btn btn-primary float-right">
                                                 Detalles
                                              </button>
                                          </a>
                                           
                                      </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>

                        </div>
                    </div>
                </div>
              
            </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
              </div>
            
            
          </div>
        </div>
    </div>

    

    <script type="text/javascript">


        function modalHistorial(id){
          var id = id;
          $("#id").val(id);
        }

        function showHistory(target){
          $("#history_Table").show();
          $("#loan_Table").hide();
        }

        function returnBook(id, book_id, return_date, target) {
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
              if (willDelete) {
                
                axios.put('/loans', {
                    id: id,
                    status: 0,
                    return_date: return_date
                })
                .then(function (response) {
                    if (response.data.code == 200) {
                        swal( response.data.message, {
                          icon: "success",
                        });
                        $(target).parent().parent().remove();
                    } else {
                        swal( response.data.message, {
                          icon: "error",
                        });
                    }
                  })
                  .catch(function (error) {
                });
              }
            });
        }

        </script>


</x-app-layout>