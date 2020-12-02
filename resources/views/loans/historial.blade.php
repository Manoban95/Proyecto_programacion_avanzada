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
          
        </div>
      </div>     
    </x-slot>   

    	@if (isset($loans) && count($loans)>0)

		    		<div class="py-12">
		          
		                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
		                          <table class="table table-striped table-bordered">
		                      <thead class="thead-dark">
		                        <tr>
		                          <th scope="col">Libro</th>
		                          <th scope="col">Fecha de préstamo</th>
		                          <th scope="col">Fecha de devolución </th>
		                          <th scope="col">Estado </th>
		                          <th scope="col"></th>

		                        </tr>
		                      </thead>
		                      <tbody>

		                        
		                         @foreach($loans as $loan)
    	   							@if($loan->user_id==$user->id)
		                              <tr class="loan_Table" >
		                              	@foreach($books as $book)
		                              	  @if($book->id==$loan->book_id)
			                                <td>
			                                  {{ $book->title }}
			                                </td>
			                              @endif
		                                @endforeach
			                              <td>
			                             	{{ $loan->loan_date }}
			                              </td>
			                              <td>
			                              	{{ $loan->return_date }}
			                              </td>
			                              <td>
			                              	@if($loan->status==1)
			                              		<span>En posesión</span>
			                              	@else
			                              		<span>Devuelto</span>
			                              	@endif
			                              </td>
			                              <td>
			                              	<button onclick="returnBook({{ $loan->id }},{{ $loan->book_id }}, '{{ Carbon::now()->timezone('America/Hermosillo')}}', this)" class="btn btn-success" @if($loan->status==0) disabled @endif>
				                                 Devolver
				                            </button>
			                              </td>
		                              </tr>
		                            @endif
		                          @endforeach
		                      </tbody>
		                    </table>

		                        </div>
		                    </div>
		            </div>
        @endif

    

    

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