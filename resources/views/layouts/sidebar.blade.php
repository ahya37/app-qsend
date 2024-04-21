<div class="deznav ">
    <div class="deznav-scroll ">
        <ul class="metismenu " id="menu">

            <li><a class="has-arrow ai-icon {{request()->is('message/*') ? 'cs-bg-color' : ''}}" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-050-info"></i>
                    <span class="nav-text">Pesan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('message.create')}}">Kirim Pesan Teks</a></li>
                    <li><a href="/">Kirim Pesan Media</a></li>
                </ul>
            </li>
            <li><a href="{{route('qrcode.create')}}" class="{{request()->is('qrcode/create') ? 'cs-bg-color' : ''}}" aria-expanded="false">
                <i class="fa fa-qrcode" aria-hidden="true"></i>
                <span class="nav-text">Qr Code</span>
            </a>
        </li>
        </ul>
    </div>
</div>