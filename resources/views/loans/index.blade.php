  @php
      use Carbon\Carbon;
  @endphp
<x-app-layout>
    <x-slot name="header">
      <div class="row">
        <div class="col-md-8 col-12">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Loans') }}
            </h2>
        </div>
        <div class="col-md-4 col-12">
          
          

           @if (Auth::user()->hasPermissionTo('add books')) 
                   <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addBookModal">
                    Add Book
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
              <th scope="col">Libro</th>
              <th scope="col">Usuario</th>
              <th scope="col">Fecha prestamo</th>
              <th scope="col">Fecha devolucion</th>
              <th scope="col">Estado</th>
              

            </tr>
          </thead>
          <tbody>

            @if (isset($loans) && count($loans)>0)
            @foreach($loans as $loan)
            @foreach($users as $user)
            <tr>
              <th scope="row">
                 {{ $loan->id }}
              </th>
              <td>
                 {{ $loan->book_id }}
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
                @if($loan->status==0)
                <span>Devuelto</span>
                @elseif($loan->status==1)
                <span>En posesión</span>
                @endif
              </td>
                    <td> 
                      <button onclick="returnBook({{ $loan->id }},{{ $loan->book_id }}, '{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success" >
                           Devolver
                      </button>
                    </td>
          
            </tr>
              @endforeach
              @endforeach
            @endif
          </tbody>
        </table>

            </div>
        </div>
    </div>

        <script type="text/javascript">

            function returnBook(id, book_id, return_date, target) {
              console.log(book_id)
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