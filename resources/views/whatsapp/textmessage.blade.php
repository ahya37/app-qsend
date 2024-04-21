@extends('layouts.app')
@section('title',$title)
@push('addon-styles')
@endpush
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        @include('layouts.notification')
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kirim pesan teks</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{route('message.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kontak</label>
                                    <textarea class="form-control" name="contacts" rows="8" id="myContacts"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm  cs-bg-color cs-color-with"><i class="fa fa-paper-plane"></i> Kirim Pesan</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pesan</label>
                                    <textarea class="form-control" name="message" rows="8" id="comment"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-scripts')
     <script>
        const textarea = document.getElementById('myContacts');
        textarea.setAttribute('placeholder', "+62890xxxx \n+62870xxxx \n+62830xxxx");
     </script>
@endpush