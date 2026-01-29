@extends('layouts.app')

@section('app-lists')
    
@if (session('alert'))
<script>
    alert("{{ session('alert') }}");
</script>
@endif

<div class="container-fluid py-4 px-3">
    <div class="row">
        <div class="col-12 px-4">
            <h2 class="fw-bold mb-4">{{ __('messages.manage_apps') }}</h2>
            
            
            <form method="GET" class="row ">
                <div class="col-md-9 d-flex">
                    <input type="text" name="search" class="form-control" placeholder="{{ __('messages.search_in_apps') }}" > {{-- value="{{ request('search') }}" --}}
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 ">
                        <i class="fas fa-search me-1"></i> {{ __('messages.search') }}
                    </button>
                    <a href="{{ route('apps.create') }}" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-1"></i> {{ __('messages.add') }}
                    </a>
                </div>
            </form>
            

            <div class="card-body border-0 shadow-sm my-3" style="border-radius:5px;">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-muted">#</th>
                                <th class="text-muted">{{ __('messages.edit') }}</th>
                                <th class="text-muted">{{ __('messages.delete') }}</th>
                                <th class="text-muted">{{ __('messages.app_name') }}</th>
                                <th class="text-muted">App Code</th>
                                <th class="text-muted">{{ __('messages.created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($apps as $index => $app)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="{{ route('apps.edit', ['id' => $app->id]) }}" class="btn btn-warning btn-sm text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('apps.destroy', ['id' => $app->id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="">{{ $app->name }}</td>
                                <td>{{ $app->code }}</td>
                                <td>{{ $app->created_at->format('d/m/Y H:i') }}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <img src="" width="100" class="mb-3 opacity-50">
                                    <p>Chưa có người dùng nào trong danh sách.</p>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

                
                <div class="p-3 border-top">
                    {{ $apps->links('vendor.pagination.bootstrap-5') }}
                </div>
                
                {{-- <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
    </div>
</div>

@endsection

