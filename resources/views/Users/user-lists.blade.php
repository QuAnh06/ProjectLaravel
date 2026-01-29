@extends('layouts.app')

@section('user-lists')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h2 fw-bold mb-0">{{ __('messages.users') }}</h2>
        <a href="{{ route('user-lists.create') }}" class="btn btn-primary shadow-sm d-flex align-items-center gap-2 fs-0.25">
            <i class="fas fa-plus"></i> {{ __('messages.add_user') }}
        </a>
    </div>

    <div class="card shadow-sm border-0 py-0 mx-4" style="height: auto;">
        <div class="card-body p-4"> 

            <form action="{{ route('user-lists') }}" method="GET">    
                <div class="d-flex justify-content-between mb-3 gap-2">
                    <div class="input-group w-75">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0 " name="search"
                            value="{{ request('search') }}" placeholder="{{ __('messages.search_in_user') }}">
                    </div>
                    <div class="d-flex gap-2">
                        
                        @if(request()->has('search') || request()->has('status'))
                            <a href="{{ route('user-lists') }}" class="btn btn-outline-danger">Xóa lọc</a>
                        @endif

                    </div>
                    <button type="submit" class="btn btn-primary ">
                        <i class="fas fa-search me-1"></i> {{ __('messages.search') }}
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-muted fw-normal">#</th>
                            <th class="text-muted fw-normal">{{ __('messages.edit') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.delete') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.name') }}</th>
                            <th class="text-muted fw-normal">Email</th>
                            <th class="text-muted fw-normal">{{ __('messages.phone') }}</th>
                            <th class="text-muted fw-normal">{{ __('messages.created_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr>
                            <td class="text-muted">{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('user-lists.edit', $user->id) }}" class="btn btn-warning btn-sm text-white p-2" style="border-radius: 4px;">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                            </td>
                            <td>

                                <form id="delete-form" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <button type="button" class="btn btn-danger btn-sm p-2" style="border-radius: 4px;" onclick="confirmDelete({{ $user->id }})">
                                    <i class="fas fa-trash fa-fw"></i>
                                </button>
                            </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }}</td>
                            <td>{{ !empty($user->phone) ? $user->phone : '---' }}</td>
                            {{-- <td>

                                @if(Auth::check() && $user->id === Auth::user()->id)
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Online</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Offline</span>
                                @endif
                            
                                @if ($user->status == '1')
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Online</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Offline</span>
                                @endif
                            </td> --}}

                            <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                            
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <p>{{ __('messages.no_data') }}</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-3 border-top">
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        
        </div>
    </div>
</div>  


@endsection

    <template id="create-success">
        <swal-title>
            Thành công!
        </swal-title>
        <swal-icon type="success" color="#28a745"></swal-icon>
        <swal-button type="confirm" color="#0d6efd">
            Đồng ý
        </swal-button>
        <swal-param name="timer" value="3000" /> <swal-param name="allowEscapeKey" value="true" />
        <swal-param name="customClass" value='{ "popup": "border-radius-15" }' />
    </template> 

    @push('scripts')
        <script>
        @if(session('message'))
        Swal.fire({
            template: "#create-success",
            text: "{{ session('message') }}"
        });
        @endif

        function confirmDelete(userId){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-secondary"
            },
            buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No, cancel",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('delete-form');

                    // var url = "{{ route('user-lists.destroy', 'id') }}";
                    // form.action = url.replace('id', userId);

                    form.action = "/user-lists/" + userId;

                    form.submit();
                } 
            });
        }

        </script>    
    @endpush
    