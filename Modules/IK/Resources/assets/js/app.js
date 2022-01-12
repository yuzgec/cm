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
