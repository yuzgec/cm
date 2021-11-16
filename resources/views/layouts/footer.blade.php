<footer class="footer footer-transparent d-print-none">
    <div class="container">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="{{route('dashboard.index')}}" class="link-secondary">Kullanım Klavuzu</a></li>
                    <li class="list-inline-item"><a href="{{route('dashboard.index')}}" class="link-secondary">Yardım</a></li>
                    <li class="list-inline-item"><a href="{{route('dashboard.index')}}" class="link-secondary">İletişim</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                    Copyright &copy; 2021
                    <a href="." class="link-secondary">{{ config('app.name')}}</a>.
                    
                </li>
                <li class="list-inline-item">
                    <a href="{{route('dashboard.index')}}" class="link-secondary" rel="noopener">Versiyon : 1.0.0</a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</footer>