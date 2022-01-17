$('#btnIzinTalepEt').on('click', function (){
    $('#modal-izintalep').modal('show');
});
$('#btnIzinTalepSend').on('click', function (){
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
    // if(confirm('İzin talebini onaylıyor musunuz ?') == true){
    //     axios.post('/ik/IzinOnayla', {
    //         id: id,
    //         tip: type
    //     })
    //         .then(result => {
    //             $('#btnIzinDetayIzinOnayla').remove();
    //             $('#btnIzinDetayIzinReddet').remove();
    //         })
    //         .catch(error => {
    //             if(error.response.status == 406){
    //                 alert(error.response.data.Message);
    //             }else{
    //                 alert('Sistemde yaşanan bir problemden ötürü işleminizi gerçekleştiremiyoruz');
    //             }
    //         })
    // }
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
