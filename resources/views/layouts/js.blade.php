<script src="/assets/js/tabler.js"></script>
<script src="/assets/libs/litepicker/dist/litepicker.js"></script>
<script src="/assets/js/moment-with-locales.min.js"></script>
<script>
    $(document).ready(function (){
        $('[picker="date"]').each(function (i,v){
            var id = $(this).attr('id');
            var picker = new Litepicker({
                element: document.getElementById(id),
                format: 'DD.MM.YYYY',
                lang: 'tr-TR'
            })
        });
    });
</script>
