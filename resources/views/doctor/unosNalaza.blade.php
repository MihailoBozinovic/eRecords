@extends('layout.doclayout')

@section('title', 'Nalazi')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <h5 class="mb-1">Unos nalaza</h5>
                    <div class="table-responsive">
                        <form method="POST" action="{{ route('insertNalazi.doctor', [$id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-floating mb-3">
                                <input name="picture" class="form-control form-control-lg" id="formFileLg" type="file" />
                            </div>
                            <button type="submit" name="submit" class="btn btn-outline-primary w-100 m-2">Unesi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection