$(document).ready(function() {
    $.ajaxSetup({
        headers:
            {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
});
$('#btnIzinTalepEt').on('click', function (){
    var tmp = '<div class="d-flex flex-column align-items-center justify-content-center gap-2"><div class="spinner-border text-cyan" role="status"></div><div><h1>Yükleniyor<span class="animated-dots"></span></h1></div></div>';
    $('#modal-izintalep .modal-body').html(tmp);
    $('#modal-izintalep').modal('show');
    $('#modal-izintalep').load('/ik/IzinTalepEt');
});
$(document).on('click','#btnIzinTalepSend', function (){
    $(this).data('originaltext',$(this).text());
    $(this).html('Lütfen Bekleyin<span class="animated-dots"></span>').attr('disabled','disabled');
    var data = $('#modal-izintalep form#izinTalepForm').serialize();
    axios.post('/ik/IzinTalep', data)
.then(res => {
        alert('İzin Talebi başarıyla oluşturulmuştur');
        document.location.reload();
    })
        .catch(err => {
            console.log(err);
        })
});
$('#btnAvansTalepEt').on('click', function (){
    $('#modal-avanstalep').modal('show');
});
$('#btnAvansTalepSend').on('click', function (){
    var data = $('#modal-avanstalep form#avansTalepForm').serialize();
    axios.post('/ik/AvansTalep', data)
.then(res => {
        alert('Avans Talebi başarıyla oluşturulmuştur');
        document.location.reload();
    })
    .catch(err => {

        if(err.response.status === 422){
            var msg = "";
            $.each(err.response.data.errors, (function (i,v){
                msg = msg + v + "\r\n";
            }));
            alert(msg);
        }
    })
})
$(document).on('click', '#btnIzinDetayIzinOnayla', function (){
    var id = $(this).data('id');
    var type = $(this).data('type');
    if(confirm('İzin talebini onaylıyor musunuz ?') == true){
        axios.post('/ik/IzinOnayla', {
            id: id,
            tip: type
        })
            .then(result => {
                $('#btnIzinDetayIzinOnayla').remove();
                $('#btnIzinDetayIzinReddet').remove();
            })
            .catch(error => {
                if(error.response.status == 406){
                    alert(error.response.data.Message);
                }else{
                    alert('Sistemde yaşanan bir problemden ötürü işleminizi gerçekleştiremiyoruz');
                }
            })
    }
});
$(document).on('click', '#btnIzinDetayIzinReddet', function (){
    var id = $(this).data('id');
    var type = $(this).data('type');
    let mesaj = prompt("Lütfen red sebebini belirtin");
    if(mesaj != null){
        axios.post('/ik/IzinReddet', {
            id: id,
            tip: type,
            message: mesaj
        })
            .then(result => {
                $('#btnIzinDetayIzinOnayla').remove();
                $('#btnIzinDetayIzinReddet').remove();
            })
            .catch(error => {
                if(error.response.status == 406){
                    alert(error.response.data.Message);
                }else{
                    alert('Sistemde yaşanan bir problemden ötürü işleminizi gerçekleştiremiyoruz');
                }
            })
    }else{
        alert('İptal Edildi');
    }
});
$(document).on('click', '#btnAvansDetayAvansOnayla', function (){
    var id = $(this).data('id');
    var type = $(this).data('type');
    if(confirm('Avans talebini onaylıyor musunuz ?') == true){
        axios.post('/ik/AvansOnayla', {
            id: id,
            tip: type
        })
            .then(result => {
                $('#btnAvansDetayAvansOnayla').remove();
                $('#btnAvansDetayAvansReddet').remove();
            })
            .catch(error => {
                if(error.response.status == 406){
                    alert(error.response.data.Message);
                }else{
                    alert('Sistemde yaşanan bir problemden ötürü işleminizi gerçekleştiremiyoruz');
                }
            })
    }
});
$(document).on('click', '#btnAvansDetayAvansReddet', function (){
    var id = $(this).data('id');
    var type = $(this).data('type');
    let mesaj = prompt("Lütfen red sebebini belirtin");
    if(mesaj != null){
        axios.post('/ik/AvansReddet', {
            id: id,
            tip: type,
            message: mesaj
        })
            .then(result => {
                $('#btnAvansDetayAvansOnayla').remove();
                $('#btnAvansDetayAvansReddet').remove();
            })
            .catch(error => {
                if(error.response.status == 406){
                    alert(error.response.data.Message);
                }else{
                    alert('Sistemde yaşanan bir problemden ötürü işleminizi gerçekleştiremiyoruz');
                }
            })
    }else{
        alert('İptal Edildi');
    }
});
$(document).on('click', '[data-toggle="izinDetay"]', function (){
    var id = $(this).data('id');
    axios.get('/ik/IzinDetay/' + id)
        .then(result => {
            var res = $(result.data);
            var content = $('div#content', result.data);
            $('#modal-izinDetay .modal-body').html(res[0].innerHTML);
            $('#modal-izinDetay .modal-footer').html(res[2].innerHTML);
        })
    $('#modal-izinDetay').modal('show');
});
$(document).on('click', '[data-toggle="avansDetay"]', function (){
    var id = $(this).data('id');
    axios.get('/ik/AvansDetay/' + id)
        .then(result => {
            var res = $(result.data);
            var content = $('div#content', result.data);
            $('#modal-avansDetay .modal-body').html(res[0].innerHTML);
            $('#modal-avansDetay .modal-footer').html(res[2].innerHTML);
        })
    $('#modal-avansDetay').modal('show');
});
$(document).on('click', '[data-toggle="userIzinEkle"]', function (){
    var user = $(this).data('user');
    var tmp = '<div class="d-flex flex-column align-items-center justify-content-center gap-2"><div class="spinner-border text-cyan" role="status"></div><div><h1>Yükleniyor<span class="animated-dots"></span></h1></div></div>';
    $('#modal-userIzinEkle .modal-body').html(tmp);
    $('#modal-userIzinEkle').modal('show');
    $('#modal-userIzinEkle').load('/ik/IzinEkle/' + user);
});
$(document).on('click','#btnIzinEkleSend', function (){
    $(this).data('originaltext',$(this).text());
    $(this).html('Lütfen Bekleyin<span class="animated-dots"></span>').attr('disabled','disabled');
    var data = $('#modal-userIzinEkle form#izinEkleForm').serialize();
    axios.post('/ik/IzinOlustur', data)
        .then(res => {
            alert('İzin başarıyla oluşturulmuştur');
            document.location.reload();
        })
        .catch(err => {
            console.log(err);
        })
});
$(document).on('change', '#izinTalepForm #izinTalep_baslangic_tarihi,#izinTalepForm  #izinTalep_baslangic_saati,#izinTalepForm  #izinTalep_bitis_tarihi,#izinTalepForm  #izinTalep_bitis_saati', function (){
    var baslangic = $('#izinTalepForm #izinTalep_baslangic_tarihi').val() + " " + $("#izinTalepForm #izinTalep_baslangic_saati").val(),
        bitis = $('#izinTalepForm #izinTalep_bitis_tarihi').val() + " " + $("#izinTalepForm #izinTalep_bitis_saati").val(),
        tur = $('#izinTalepForm #izinTalep_tur').val();

    $.ajax({
        type: 'GET',
        url: '/ik/IzinHesapla',
        data: 'baslangic=' + baslangic + '&bitis=' + bitis + '&tur=' + tur,
        success: function (response){
            $('#izinTalepForm #izinTalep_gun').val(response.Fark + ' gün');
        }
    })
})
$(document).on('change', '#izinEkleForm #izinTalep_baslangic_tarihi,#izinEkleForm  #izinTalep_baslangic_saati,#izinEkleForm  #izinTalep_bitis_tarihi,#izinEkleForm  #izinTalep_bitis_saati', function (){
    var baslangic = $('#izinEkleForm #izinTalep_baslangic_tarihi').val() + " " + $("#izinEkleForm #izinTalep_baslangic_saati").val(),
        bitis = $('#izinEkleForm #izinTalep_bitis_tarihi').val() + " " + $("#izinEkleForm #izinTalep_bitis_saati").val();

    $.ajax({
        type: 'GET',
        url: '/ik/IzinHesapla',
        data: 'baslangic=' + baslangic + '&bitis=' + bitis,
        success: function (response){
            $('#izinEkleForm #izinTalep_gun').val(response.Fark + ' gün');
        }
    })
})
$(document).on('click', '#btnIzinDetayIzinSil', function (){
    var id = $(this).data('id');
    var button = $(this);
    var sonuc = confirm('Bu kaydı silmek istediğinize emin misiniz ?');
    if(sonuc){
        $(button).attr('originalText', $(button).text());
        $(button).attr('disabled','disabled').addClass('disabled').html('Lütfen bekleyin <span class="animated-dots"></span>');
        $.ajax({
            type: 'DELETE',
            url: '/ik/IzinSil/' + id,
            success: function (response){
                alert('İzin başarıyla silinmiştir');
                document.location.reload();
            },
            error: function (error){
                $(button).text($(button).attr('originalText'));
                $(button).removeAttr('originalText', $(button).text()).removeClass('disabled').removeAttr('disabled');
                alert('Sistemde yaşanan bir sorundan ötürü işleminizi gerçekleştiremedik');
            }
        })
    }
})
$(document).on('click', '[data-toggle="userPassive"]', function (){
    var id = $(this).data('user');
    var result = confirm('Kullanıcıyı Pasifleştirmek istediğinize emin misiniz ?');
    var t = $(this);
    if(result){
        $.ajax({
            type: 'POST',
            url: '/ik/KullaniciPasiflestir',
            data: 'user=' + id,
            success: function (response){
                t.closest('.card').closest('.col-md-6.col-lg-3').remove();
            },
            error: function (error){
                alert('Sistemde yaşanan bir problemden ötürü işleminizi gerçekleştiremiyoruz. Lütfen tekrar deneyin.');
            }
        })
    }
})
